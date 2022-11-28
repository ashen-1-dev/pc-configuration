<?php

namespace App\Http\Controllers\Build\dto\CompatibleChecker;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;

class BuildCompatibleStatusDto extends \Spatie\LaravelData\Data
{
    public function __construct(
        public bool           $isCompatible,
        #[DataCollectionOf(ComponentStatusDto::class)]
        public DataCollection $componentsStatus
    )
    {
    }
}
