<?php

namespace App\Services\Build\ComponentChecker;

use App\Http\Controllers\Build\dto\BuildChecker\CompatibleChecker\CheckerResult;
use App\Http\Controllers\Component\dto\GetComponentDto;

class PowerSupplyChecker extends ComponentChecker
{

    public function iterate(GetComponentDto $source, GetComponentDto $otherComponent): CheckerResult
    {
        $data = new CheckerResult(isCompatible: true, message: '');

        if ($otherComponent->type == 'motherboard') {
            $data = Checkers::checkPowerSupplyWithMotherboard($source, $otherComponent);
        }

        if ($otherComponent->type == 'gpu') {
            $data = Checkers::checkGPUWithPowerSupply($otherComponent, $source);
        }

        return $data;
    }
}
