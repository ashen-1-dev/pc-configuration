<?php

namespace App\Http\Controllers\ComponentType;

use App\Http\Controllers\Controller;
use App\Services\ComponentType\ComponentTypeService;
use Illuminate\Http\Request;

class ComponentTypeController extends Controller
{
    private readonly ComponentTypeService $componentTypeService;

    public function __construct(ComponentTypeService $componentTypeService)
    {
        $this->componentTypeService = $componentTypeService;
    }

    public function index()
    {
        return $this->componentTypeService->getComponentTypes();
    }

    public function getRequiredAttributes(Request $request, string $type)
    {
        return $this->componentTypeService->getRequiredAttributes($type);
    }
}
