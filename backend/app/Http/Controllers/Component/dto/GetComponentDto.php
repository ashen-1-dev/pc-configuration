<?php

namespace App\Http\Controllers\Component\dto;

use App\Models\Components\Component;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class GetComponentDto extends Data
{
    public function __construct(
        public int            $id,
        public string         $type,
        #[DataCollectionOf(GetAttributeDto::class)]
        public DataCollection $attributes
    )
    {
    }

    public static function fromModel(Component $component): GetComponentDto
    {
        return new self(
            id: $component->id,
            type: $component->type->name,
            attributes: GetAttributeDto::collection($component->attributes->all())
        );
    }
}
