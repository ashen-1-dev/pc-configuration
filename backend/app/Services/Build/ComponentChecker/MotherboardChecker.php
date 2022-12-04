<?php

namespace App\Services\Build\ComponentChecker;

use App\Http\Controllers\Build\dto\BuildChecker\CompatibleChecker\CheckerResult;
use App\Http\Controllers\Component\dto\GetComponentDto;

class MotherboardChecker extends ComponentChecker
{

    public function iterate(GetComponentDto $source, GetComponentDto $otherComponent): CheckerResult
    {
        $data = new CheckerResult(isCompatible: true, message: '');

        if ($otherComponent->type == 'ram') {
            $data = Checkers::checkRAMWithMotherboard($otherComponent, $source);
        }

        if ($otherComponent->type == 'cpu') {
            $data = Checkers::checkCPUWithMotherboard($otherComponent, $source);
        }

        if ($otherComponent->type == 'case') {
            $data = Checkers::checkCaseWithMotherboard($otherComponent, $source);
        }

        if ($otherComponent->type == 'powersupply') {
            $data = Checkers::checkPowerSupplyWithMotherboard($otherComponent, $source);
        }

        if ($otherComponent->type == 'cpu_cooler') {
            $data = Checkers::checkWithCPUWithCPUCooler($source, $otherComponent);
        }

        return $data;
    }
}
