<?php

namespace App\Http\Controllers\Component\dto;

use Spatie\LaravelData\Data;


class GetAttributeDto extends Data
{
    public function __construct(
        public string $name,
        public string $value,
    )
    {
    }
}
