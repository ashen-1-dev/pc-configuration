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
    ];


    public static function getAttributes(): array
    {
        return (new RequiredAttributesForMotherboard())->prepare();
    }
}
