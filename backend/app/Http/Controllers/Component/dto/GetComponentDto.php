<?php

namespace App\Http\Controllers\Component\dto;

use App\Http\Controllers\Component\dto\Attribute\GetAttributeDto;
use App\Models\Component\Component;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class GetComponentDto extends Data
{
    public function __construct(
        public int            $id,
        public string         $type,
        public string         $name,
        public ?string        $description,
        public ?string        $photoUrl,
        #[DataCollectionOf(GetAttributeDto::class)]
        public DataCollection $attributes
    )
    {
    }

    public static function fromModelCollection(Collection $components)
    {
        return GetComponentDto::collection(
            $components->map(fn(Component $component) => self::fromModel($component))
        );
    }

    public static function fromModel(Component $component): GetComponentDto
    {
        return new self(
            id: $component->id,
            type: $component->type->name,
            name: $component->name,
            description: $component->description,
            photoUrl: $component->getAvatarUrl(),
            attributes: GetAttributeDto::collection($component->attributes->all())
        );
    }

}
