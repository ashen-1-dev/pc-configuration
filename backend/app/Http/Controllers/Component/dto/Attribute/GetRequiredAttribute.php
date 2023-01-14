<?php

namespace App\Http\Controllers\Component\dto\Attribute;

use Spatie\LaravelData\Data;

class GetRequiredAttribute extends Data
{
    public function __construct(
        public string $name,
        public ?array $list,
    )
    {
    }
}
