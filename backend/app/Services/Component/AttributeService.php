<?php

namespace App\Services\Component;

use App\Http\Controllers\Component\dto\CreateAttributeDto;
use App\Models\Components\Attribute;
use Spatie\LaravelData\DataCollection;

class AttributeService
{
    /**
     * @return bool
     * @var CreateAttributeDto[] $createAttributeDto
     */
    public function createAttributes(int $componentId, DataCollection $createAttributeDto): bool
    {
        return Attribute::insert();
        //TODO: FIXME!
    }
}
