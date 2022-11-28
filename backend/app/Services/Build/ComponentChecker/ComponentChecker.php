<?php

namespace App\Services\Build\ComponentChecker;

use App\Http\Controllers\Build\dto\CompatibleChecker\ComponentStatusDto;
use App\Http\Controllers\Component\dto\GetComponentDto;
use Spatie\LaravelData\DataCollection;

interface ComponentChecker
{
    public function check(GetComponentDto $source, DataCollection $targets): ComponentStatusDto;
}
