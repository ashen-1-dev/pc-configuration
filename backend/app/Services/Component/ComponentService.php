<?php

namespace App\Services\Component;

use App\Http\Controllers\Component\dto\ComponentQuery;
use App\Http\Controllers\Component\dto\CreateAttributeDto;
use App\Http\Controllers\Component\dto\CreateComponentDto;
use App\Http\Controllers\Component\dto\GetComponentDto;
use App\Models\Component\Component;
use App\Models\Component\Type;
use Spatie\LaravelData\DataCollection;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ComponentService
{
    public function getComponents(ComponentQuery $componentQuery)
    {
        $components = Component::filter($componentQuery)
            ->with(['attributes', 'type'])
            ->get();

        return $components->map(fn($component) => GetComponentDto::fromModel($component))->values();
    }

    public function deleteComponent(int $id)
    {
        $component = Component::findOrFail($id);
        $component->builds()->detach();
        $component->delete();
    }

    public function createComponent(CreateComponentDto $createComponentDto): GetComponentDto
    {
        $typeId = Type::where('name', $createComponentDto->type)->firstOrFail()->id;
        $this->validateComponents($createComponentDto->attributes, $typeId);


        $component = Component::create($createComponentDto->toModel($typeId));

        if ($createComponentDto->photo) {
            $component->addAvatar($createComponentDto->photo);
        }

        $component->attributes()->createMany($createComponentDto->attributes->toArray());
        return GetComponentDto::fromModel($component);
    }

    public function updateComponent(int $id, CreateComponentDto $createComponentDto): GetComponentDto
    {
        $component = Component::findOrFail($id);
        $component->update($createComponentDto->toArray());

        if ($createComponentDto->photo) {
            $component->addAvatar($createComponentDto->photo);
        } else {
            $component->removeAvatar();
        }

        $createComponentDto
            ->attributes
            ->map(fn(CreateAttributeDto $x) => $component->attributes()->updateOrCreate($x->toArray()));
        return GetComponentDto::fromModel($component);
    }

    private function validateComponents(DataCollection $attributes, int $componentTypeId): bool
    {
        $requiredAttributes = Type::findOrFail($componentTypeId)->requiredAttributes;
        foreach ($requiredAttributes as $requiredAttribute) {
            $attribute = $attributes->where('name', '=', $requiredAttribute->name)->first();
            if (!isset($attribute)) {
                throw new UnprocessableEntityHttpException('please fill all required attributes for this component');
            }
            $list = $requiredAttribute->list;
            if (isset($list) && !in_array($attribute->value, $list)) {
                throw new UnprocessableEntityHttpException('please fill required attributes value with provided list');
            }
        }
        return true;
    }
}
