<?php

namespace App\Services\Build\ComponentChecker;

use App\Http\Controllers\Build\dto\BuildChecker\CompatibleChecker\CheckerResult;
use App\Http\Controllers\Component\dto\GetComponentDto;

class CaseChecker extends ComponentChecker
{
    public function iterate(GetComponentDto $source, GetComponentDto $otherComponent): CheckerResult
    {
        $data = new CheckerResult(isCompatible: true, message: '');

        if ($otherComponent->type == 'motherboard') {
            $data = Checkers::checkCaseWithMotherboard($source, $otherComponent);
        }

        if ($otherComponent->type == 'cpu_cooler') {
            $data = Checkers::checkCaseWithCPUCooler($source, $otherComponent);
        }
        return $data;
    }
}
