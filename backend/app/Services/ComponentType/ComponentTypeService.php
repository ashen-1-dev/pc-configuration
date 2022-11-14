<?php

namespace App\Services\ComponentType;

use App\Http\Controllers\Component\dto\Attribute\GetRequiredAttribute;
use App\Http\Controllers\ComponentType\dto\GetComponentTypeDto;
use App\Models\Components\Type;

class ComponentTypeService
{

    /** @return  GetComponentTypeDto[] */
    public function getComponentTypes(): array
    {
        return GetComponentTypeDto::collection(Type::all())->toArray();
    }

    /** @return  GetRequiredAttribute[] */
    public function getRequiredAttributes(string $typeName): array
    {
        $type = Type::with('requiredAttributes')->where('name', $typeName)->firstOrFail();
        $attributes = $type->requiredAttributes;
        return GetRequiredAttribute::collection($attributes)->wrap('attributes')->toArray();
    }
}
