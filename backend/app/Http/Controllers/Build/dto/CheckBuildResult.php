<?php

namespace App\Http\Controllers\Build\dto;

use App\Http\Controllers\Build\dto\BuildChecker\CompatibleChecker\BuildCompatibleStatus;
use App\Http\Controllers\Build\dto\BuildChecker\EnergyConsumptionStatus;
use App\Http\Controllers\Build\dto\BuildChecker\RequirementComponentsStatus;

class CheckBuildResult extends \Spatie\LaravelData\Data
{
    public function __construct(
        public bool                        $isReady,
        public BuildCompatibleStatus       $buildCompatibleStatus,
        public EnergyConsumptionStatus     $energyConsumptionStatus,
        public RequirementComponentsStatus $requirementComponentsStatus,
    )
    {
    }
}
