<?php

namespace App\Services\Build;

use App\Http\Controllers\Build\dto\CheckBuildResult;
use App\Http\Controllers\Build\dto\CreateBuildDto;
use App\Http\Controllers\Build\dto\EditBuildDto;
use App\Http\Controllers\Build\dto\GetBuildDto;
use App\Http\Controllers\Build\dto\RawBuildDto;
use App\Models\Build\Build;
use App\Models\User\User;
use Illuminate\Validation\ValidationException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class BuildService
{
    const reportLifetimeMinutes = 5;

    /** @return GetBuildDto[] */
    public function getBuilds(BuildQuery $buildQuery): array
    {
        $builds = Build::filter($buildQuery)->with(['components', 'user'])->get();

        return GetBuildDto::fromModelCollection($builds)->toArray();
    }

    public function getBuild(int $id): GetBuildDto
    {
        return GetBuildDto::from(Build::with(['user', 'components'])->findOrFail($id));
    }

    public function createBuild(CreateBuildDto $createBuildDto, int $userId): GetBuildDto
    {
        $build = Build::create([
            ...$createBuildDto->toArray(),
            'user_id' => $userId,
            'is_ready' => $this->checkBuildIsReady($createBuildDto)->isReady
        ]);
        $build->components()->attach($createBuildDto->componentsIds);
        $build->load(['components', 'user']);
        return GetBuildDto::from($build);
    }

    public function addBuild(int $buildId, int $userId): GetBuildDto
    {
        $user = User::findOrFail($userId);
        $build = Build::findOrFail($buildId)->load('components');
        if ($user->builds->contains($buildId)) {
            throw ValidationException::withMessages(['build already yours']);
        }
        $componentIds = $build->components->map(fn($c) => $c->id)->toArray();
        $dto = CreateBuildDto::from([...$build->toArray(), 'componentsIds' => $componentIds]);
        return $this->createBuild($dto, $userId);
    }

    public function removeBuild($id): void
    {
        $userId = \Auth::id();
        $build = Build::findOrFail($id);

        if ($build->user_id !== $userId) {
            throw new BadRequestException("can't delete not your build");
        }

        $build->components()->detach();
        $build->delete();
    }

    public function updateBuild(EditBuildDto $editBuildDto, int $id): GetBuildDto
    {
        $build = Build::with('components', 'user')->findOrFail($id);
        $build->updateOrFail(array_filter([
            ...$editBuildDto->toArray(),
            'is_ready' => $this->checkBuildIsReady($editBuildDto)->isReady
        ]));
        if (isset($editBuildDto->componentsIds)) {
            $build->components()->sync($editBuildDto->componentsIds);
        }
        $build->refresh();
        return GetBuildDto::from($build);
    }

    public function checkBuildIsReady(
        GetBuildDto|RawBuildDto|CreateBuildDto|EditBuildDto $getBuildDto
    ): CheckBuildResult
    {
        $checker = new BuildChecker();
        return $checker->checkBuildIsReady($getBuildDto);
    }

    public function createExcelReport(int $id): string
    {
        $build = Build::findOrFail($id);

        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setTitle('Сборка #' . $build->id);


        $report = [
            ['Название сборки', $build->name],
            ['Описание сборки', $build->description],
            ['Автор сборки', $build->user->first_name . ', ' . $build->user->email],
            ['Готовая сборка', $build->is_ready ? 'Да' : 'Нет'],
            ['', ''],
            ['Список комплектующих', ''],
        ];

        foreach ($build->components as $component) {
            $report[] = [$component->type->name, $component->name];
        }

        $report[] = ['', ''];
        $report[] = ['Отчет сгенерирован в приложенни', \Config::get('app.name')];
        $report[] = ['', \Config::get('app.url')];

        $activeWorksheet->fromArray($report);

        $activeWorksheet->getColumnDimension('A')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('B')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        $path = base_path() . '/storage/app/public/reports/report_' . $build->id . '_' . now()->timestamp . '.xlsx';
        $writer->save($path);

        return $path;
    }

}
