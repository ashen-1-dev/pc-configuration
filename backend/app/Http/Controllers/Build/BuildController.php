<?php

namespace App\Http\Controllers\Build;

use App\Http\Controllers\Build\dto\CreateBuildDto;
use App\Http\Controllers\Build\dto\EditBuildDto;
use App\Http\Controllers\Build\dto\RawBuildDto;
use App\Http\Controllers\Controller;
use App\Services\Build\BuildQuery;
use App\Services\Build\BuildService;
use Exception;
use Illuminate\Http\Request;

class BuildController extends Controller
{
    private readonly BuildService $buildService;

    public function __construct(BuildService $buildService)
    {
        $this->buildService = $buildService;
    }

    public function index(Request $request)
    {
        $dto = BuildQuery::from($request);
        return $this->buildService->getBuilds($dto);
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
        $this->buildService->removeBuild($id);
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

    public function getAuthUserBuilds()
    {
        $dto = BuildQuery::from(['user_id' => \Auth::id()]);
        return $this->buildService->getBuilds($dto);
    }

    public function checkBuildIsReady(Request $request)
    {
        $dto = RawBuildDto::from(['componentsIds' => $request->componentsIds]);
        return response()->json($this->buildService->checkBuildIsReady($dto), 200);
    }

    public function createExcelReport(int $id)
    {
        try {
            $url = $this->buildService->createExcelReport($id);
            return \Response::download($url)->deleteFileAfterSend();
        } catch (Exception) {
            return \Response::json(['success' => false, 'message' => 'ошибка при генерации отчета']);
        }
    }
}
