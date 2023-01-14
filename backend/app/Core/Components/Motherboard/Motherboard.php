<?php

namespace App\Core\Components\Motherboard;

use App\Core\Components\Component;

class Motherboard extends Component
{
    public readonly string $name;
    public readonly array $attributes;

    public function __construct()
    {
        $this->name = 'motherboard';
        $this->attributes = [
            'socket' => [],
            'form_factor' => ['list' => array_keys(MotherboardFormFactor::formFactor)],
            'chipset' => [],
            'memory_slots' => [],
            'memory_type' => [],
            'sata_slots' => [],
            'm2_slots' => [],
            'power_supply_form_factor' => [],
            'power_supply_main_socket' => [],
            'power_supply_cpu_socket' => [],
            'energy_consumption' => []
        ];
    }
}
