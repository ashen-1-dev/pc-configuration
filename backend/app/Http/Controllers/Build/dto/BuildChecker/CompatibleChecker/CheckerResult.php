<?php

namespace App\Http\Controllers\Build\dto\BuildChecker\CompatibleChecker;

use Spatie\LaravelData\Data;

class CheckerResult extends Data
{
    public function __construct(
        public bool    $isCompatible,
        public ?string $message,
    )
    {
    }
}
