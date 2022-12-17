<?php

namespace App\Http\Controllers\Build\dto;

use Spatie\LaravelData\Attributes\Validation\ArrayType;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;

class CreateBuildDto extends \Spatie\LaravelData\Data
{
    public function __construct(
        #[Required]
        public string  $name,
        public ?string $description,
        #[ArrayType, Min(1)]
        public array   $componentsIds,
    )
    {
    }
}
