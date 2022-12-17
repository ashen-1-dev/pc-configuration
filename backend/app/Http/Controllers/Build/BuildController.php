<?php

namespace App\Http\Controllers\Build;

use App\Http\Controllers\Build\dto\CreateBuildDto;
use App\Http\Controllers\Build\dto\EditBuildDto;
use App\Http\Controllers\Build\dto\RawBuildDto;
use App\Http\Controllers\Controller;
use App\Services\Build\BuildService;
use Illuminate\Http\Request;

class BuildController extends Controller
{
    private readonly BuildService $buildService;

    public function __construct(BuildService $buildService)
    {
        $this->buildService = $buildService;
    }

    public function index()
    {
        return $this->buildService->getBuilds();
    }

    public function show(int $id)
    {
        return $this->buildService->getBuild($id);
    }

    public function store(Request $request)
    {
        $dto = CreateBuildDto::from($request);
        $userId = \Auth::id();
        return $this->buildService->createBuild($dto, $userId);
    }

    public function destroy($id)
    {
        return $this->buildService->removeBuild($id);
    }

    public function update(Request $request, int $id)
    {
        $dto = EditBuildDto::from($request);
        return $this->buildService->updateBuild($dto, $id);
    }

    public function addBuildToUser(Request $request, $buildId)
    {
        $userId = \Auth::id();
        return $this->buildService->addBuild($buildId, $userId);
    }

    public function checkBuildIsReady(Request $request)
    {
        $dto = RawBuildDto::from(['componentsIds' => $request->componentsIds]);
        return $this->buildService->checkBuildIsReady($dto);
    }
}
