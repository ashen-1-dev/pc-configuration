<?php

namespace App\Http\Controllers\Component\dto;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CreateComponentDto extends Data
{
    public function __construct(
        #[Required, StringType]
        public string         $name,
        #[StringType]
        public ?string        $description,
        #[IntegerType]
        public int            $typeId,
        #[StringType]
        public ?string        $photoUrl,
        #[DataCollectionOf(CreateAttributeDto::class)]
        public DataCollection $attributes,
    )
    {
    }

    public function toModel(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'type_id' => $this->typeId,
            'attributes' => $this->attributes->toArray(),
            'photo_url' => $this->photoUrl,
        ];
    }
}

class CreateAttributeDto extends Data
{
    public function __construct(
        #[Required, StringType]
        public string $name,
        #[Required, StringType]
        public string $value,
    )
    {
    }

    public function toModelWithComponentId(int $componentId): array
    {
        return [
            'name' => $this->name,
            'value' => $this->value,
            'component_id' => $componentId,
        ];
    }
}
