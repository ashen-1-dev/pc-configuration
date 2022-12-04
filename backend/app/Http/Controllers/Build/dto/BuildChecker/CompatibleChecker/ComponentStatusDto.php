<?php

namespace App\Http\Controllers\Build\dto\BuildChecker\CompatibleChecker;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;

class ComponentStatusDto extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int             $componentId,
        public bool            $isCompatible,
        #[DataCollectionOf(NotCompatibleComponentDto::class)]
        public ?DataCollection $notComaptibleComponents = null
    )
    {
    }
}
