<?php

namespace App\Http\Controllers\Build\dto\BuildChecker\CompatibleChecker;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;

class BuildCompatibleStatus extends \Spatie\LaravelData\Data
{
    public function __construct(
        public bool           $isCompatible,
        #[DataCollectionOf(ComponentStatusDto::class)]
        public DataCollection $componentsStatus
    )
    {
    }
}
