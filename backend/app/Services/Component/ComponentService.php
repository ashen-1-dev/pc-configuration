<?php

namespace App\Services\Component;

use App\Http\Controllers\Component\dto\CreateComponentDto;
use App\Http\Controllers\Component\dto\GetComponentDto;
use App\Models\Components\Component;

class ComponentService
{
    private readonly AttributeService $attributeService;

    public function __construct(AttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }

    /**
     * @return GetComponentDto[]
     */
    public function getComponents(): array
    {
        $components = Component::with(['attributes', 'type'])->get();
        return $components->map(fn($component) => GetComponentDto::fromModel($component))->toArray();
    }

    public function deleteComponent(int $id)
    {
        $component = Component::findOrFail($id);
        $component->delete();
    }

    public function createComponent(CreateComponentDto $createComponentDto): GetComponentDto
    {
        $component = Component::create($createComponentDto->toModel());
        $this->attributeService->createAttributes($component->id, $createComponentDto->attributes);
        return GetComponentDto::fromModel($component);
    }
}
