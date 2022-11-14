<?php

namespace App\Http\Controllers\ComponentType\dto;

use Spatie\LaravelData\Data;

class GetComponentTypeDto extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public bool   $required
    )
    {
    }
}
