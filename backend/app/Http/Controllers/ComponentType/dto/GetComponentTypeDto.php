<?php

namespace App\Http\Controllers\ComponentType\dto;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class GetComponentTypeDto extends Data
{
    public function __construct(
        public string|Optional $id,
        public string          $name,
        public bool            $required
    )
    {
    }
}
