<?php

namespace App\Core\Components\RequiredAttributes;

class Motherboard extends Component
{
    public static string $name = 'motherboard';
    protected static array $attributes = [
        'socket',
        'form_factor',
        'chipset',
        'memory_slots',
        'memory_type',
        'sata_slots',
        'm2_slots',
        'power_supply_form_factor',
        'power_supply_main_socket',
        'energy_consumption'
    ];
}
