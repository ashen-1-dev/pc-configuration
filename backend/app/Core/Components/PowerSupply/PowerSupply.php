<?php

namespace App\Core\Components\PowerSupply;

use App\Core\Components\Component;

class PowerSupply extends Component
{
    public readonly string $name;
    public readonly array $attributes;

    public function __construct()
    {
        $this->name = 'powersupply';
        $this->attributes = [
            'power' => [],
            'form_factor' => ['list' => array_keys(PowerSupplyFormFactor::formFactor)],
            'main_socket' => [],
            'cpu_power_socket' => [],
            'sata15pin' => [],
            'molex4pin' => [],
            'pcie8pin' => [],
            'pcie6pin' => []
        ];
    }
}
