<?php

namespace App\Http\Controllers\Build\dto\BuildChecker;

use Spatie\LaravelData\Data;

class EnergyConsumptionStatus extends Data
{
    public function __construct(
        public bool $isEnough,
        public int  $totalConsumption,
        public int  $psPower,
    )
    {
    }
}
