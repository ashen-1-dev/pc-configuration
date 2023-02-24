<?php

namespace App\Core\Components\PCCase;

use App\Core\Components\Component;
use App\Core\Components\Motherboard\MotherboardFormFactor;
use App\Core\Components\PowerSupply\PowerSupplyFormFactor;

class PCCase extends Component
{
    public readonly string $name;
    public readonly array $attributes;

    public function __construct()
    {
        $this->name = 'case';
        $this->attributes = [
            'form_factor' => ['list' => array_keys(MotherboardFormFactor::formFactor)],
            'powersupply_form_factor' => ['list' => array_keys(PowerSupplyFormFactor::formFactor)],
            'max_gpu_length' => [],
            'max_cpu_cooler_height' => [],
        ];
    }
}
