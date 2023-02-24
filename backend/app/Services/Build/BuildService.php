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
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class BuildService
{
    /** @return GetBuildDto[] */
    public function getBuilds(BuildQuery $buildQuery): array
    {
        return GetBuildDto::collection(
            Build::filter($buildQuery)->with(['user', 'components'])
                ->get()
        )->toArray();
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

}
