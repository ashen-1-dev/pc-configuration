<?php

namespace App\Services\Component;

use App\Http\Controllers\Component\dto\ComponentQuery;
use App\Http\Controllers\Component\dto\CreateComponentDto;
use App\Http\Controllers\Component\dto\GetComponentDto;
use App\Models\Component\Component;
use App\Models\Component\Type;
use App\Services\FileService;

class ComponentService
{
    private readonly FileService $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function getComponents(ComponentQuery $componentQuery)
    {
        $components = Component::filter($componentQuery)
            ->with(['attributes', 'type'])
            ->get();

        return $components->map(fn($component) => GetComponentDto::fromModel($component))->values();
    }

    public function getAllComponents()
    {
        return Component::with(['attributes', 'type'])
            ->get()
            ->map(fn($component) => GetComponentDto::fromModel($component));
    }

    public function deleteComponent(int $id)
    {
        $component = Component::findOrFail($id);
        $component->builds()->detach();
        $component->delete();
    }

    public function createComponent(CreateComponentDto $createComponentDto): GetComponentDto
    {
        $photoUrl = isset($createComponentDto->photo) ?
            $this
                ->fileService
                ->uploadFile('/components/', $createComponentDto->photo)
            : null;
        $typeId = Type::where('name', $createComponentDto->type)->firstOrFail()->id;
        $component = Component::create($createComponentDto->toModel($typeId, $photoUrl));
        $component->attributes()->createMany($createComponentDto->attributes->toArray());
        return GetComponentDto::fromModel($component);
    }

    public function updateComponent(int $id, CreateComponentDto $createComponentDto): GetComponentDto
    {
        //FIXME
        $component = Component::findOrFail($id);
        $component->update($createComponentDto->toArray());
//        dd($createComponentDto->attributes->toArray());
//        $createComponentDto
//            ->attributes
//            ->map(fn(CreateAttributeDto $x) => $component->attributes()->updateOrCreate($x->toArray()));
        return GetComponentDto::fromModel($component);
    }
}
