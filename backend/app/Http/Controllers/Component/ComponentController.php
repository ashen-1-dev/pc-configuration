<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\Component\dto\ComponentQuery;
use App\Http\Controllers\Component\dto\CreateComponentDto;
use App\Http\Controllers\Controller;
use App\Services\Component\ComponentService;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    private readonly ComponentService $componentService;

    public function __construct(ComponentService $componentService)
    {
        $this->componentService = $componentService;
    }

    public function index(Request $request)
    {
        return $this->componentService->getComponents(ComponentQuery::from($request))->toArray();
    }

    public function destroy(int $id)
    {
        return $this->componentService->deleteComponent($id);
    }

    public function store(Request $request)
    {
        try {
            $dto = CreateComponentDto::from($request);
        } catch (\Exception $exception) {
            return $exception;
        }
        return $this->componentService->createComponent($dto);
    }

    public function update(Request $request, int $id)
    {
        return 'Not working yet';
//        return $this->componentService->updateComponent($id, CreateComponentDto::from($request));
    }


}
