<?php

namespace App\Core\Components\RequiredAttributes;

class RequiredAttributesForMotherboard extends RequiredAttributes
{
    public static string $name = 'motherboard';
    protected array $attributes = [
        'socket',
        'form_factor',
        'chipset',
        'memory_slots',
        'memory_type',
        'sata_ports',
        'm2_ports',
        'power_supply_form_factor',
        'power_supply_main_socket'
    ];


    public static function getAttributes(): array
    {
        return (new RequiredAttributesForMotherboard())->prepare();
    }
}
