<?php

namespace App\Http\Controllers\Component\dto;

class ComponentQuery extends \Spatie\LaravelData\Data
{
    public function __construct(
        public ?string $type,
        public ?string $search,
    )
    {
    }
}
