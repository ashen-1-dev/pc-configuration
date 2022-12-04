<?php

namespace App\Services\Build\ComponentChecker;

use App\Http\Controllers\Build\dto\BuildChecker\CompatibleChecker\CheckerResult;
use App\Http\Controllers\Component\dto\GetComponentDto;

class GPUChecker extends ComponentChecker
{
    public function iterate(GetComponentDto $source, GetComponentDto $otherComponent): CheckerResult
    {
        $data = new CheckerResult(isCompatible: true, message: '');

        if ($otherComponent->type == 'case') {
            $data = Checkers::checkGPUWithCase($source, $otherComponent);
        }

        if ($otherComponent->type == 'powersupply') {
            $data = Checkers::checkGPUWithPowerSupply($source, $otherComponent);
        }
        return $data;
    }
}
