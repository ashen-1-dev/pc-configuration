<?php

namespace App\Http\Controllers\Component\dto;

use App\Http\Controllers\Component\dto\Attribute\GetAttributeDto;
use App\Models\Components\Component;
use App\utils\transformers\InsertDomainUrl;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class GetComponentDto extends Data
{
    public function __construct(
        public int            $id,
        public string         $type,
        public string         $name,
        public ?string        $description,
        #[WithTransformer(InsertDomainUrl::class)]
        public ?string        $photoUrl,
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
            name: $component->name,
            description: $component->description,
            photoUrl: $component->photo_url,
            attributes: GetAttributeDto::collection($component->attributes->all())
        );
    }

}
