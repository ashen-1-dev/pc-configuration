<?php

namespace App\Http\Controllers\Build\dto\CompatibleChecker;

use App\Http\Controllers\Component\dto\GetComponentDto;

class NotCompatibleComponentDto extends \Spatie\LaravelData\Data
{
    public function __construct(
        public GetComponentDto $component,
        public ?string         $message
    )
    {
    }
}
