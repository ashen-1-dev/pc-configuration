<?php

namespace App\Http\Controllers\Component\dto;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CreateComponentDto extends Data
{
    public function __construct(
        #[Required, StringType]
        public string                 $name,
        #[StringType]
        public ?string                $description,
        #[Required, StringType]
        public string                 $type,
        public UploadedFile|File|null $photo,
        #[DataCollectionOf(CreateAttributeDto::class)]
        public ?DataCollection        $attributes,
    )
    {
    }

    public function toModel(int $typeId): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'type_id' => $typeId,
            'attributes' => $this->attributes->toArray(),
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
