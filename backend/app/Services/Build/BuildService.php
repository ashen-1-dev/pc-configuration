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

class BuildService
{
    /** @return GetBuildDto[] */
    public function getBuilds(): array
    {
        return GetBuildDto::collection(Build::with(['user', 'components'])->get())->toArray();
    }

    public function getBuild(int $id): GetBuildDto
    {
        return GetBuildDto::from(Build::with(['user', 'components'])->findOrFail($id));
    }

    public function createBuild(CreateBuildDto $createBuildDto, int $userId): GetBuildDto
    {
        $build = Build::create([...$createBuildDto->toArray(), 'user_id' => $userId]);
        $build->components()->attach($createBuildDto->components);
        $build->load(['components', 'user']);
        return GetBuildDto::from($build);
    }

    /** @return GetBuildDto[] */
    public function addBuild(int $buildId, int $userId): array
    {
        $user = User::findOrFail($userId);
        $build = Build::with(['components'])->findOrFail($buildId);
        if ($user->builds->contains($buildId)) {
            throw ValidationException::withMessages(['build already yours']);
        }
        $componentIds = $build->components->map(fn($c) => $c->id)->toArray();
        $dto = CreateBuildDto::from([...$build->toArray(), 'components' => $componentIds]);
        $this->createBuild($dto, $userId);
        return GetBuildDto::collection($user->builds()->with(['components'])->get())->toArray();
    }

    public function removeBuild($id): void
    {
        $build = Build::findOrFail($id);
        $build->components()->detach();
        $build->delete();
    }

    public function updateBuild(EditBuildDto $editBuildDto, int $id): GetBuildDto
    {
        $build = Build::with('components', 'user')->findOrFail($id);
        $build->updateOrFail(array_filter($editBuildDto->toArray()));
        if (isset($editBuildDto->components)) {
            $build->components()->sync($editBuildDto->components);
        }
        $build->refresh();
        return GetBuildDto::from($build);
    }

    public function checkBuildIsReady(GetBuildDto|RawBuildDto $getBuildDto): CheckBuildResult
    {
        $checker = new BuildChecker();
        return $checker->checkBuildIsReady($getBuildDto);
    }

}
