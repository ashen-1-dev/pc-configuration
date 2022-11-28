<?php

namespace App\Core\Components\RequiredAttributes;

class RequiredAttributesForPowerSupply extends RequiredAttributes
{
    public static string $name = 'powersupply';
    protected array $attributes = [
        'power',
        'form_factor',
        'main_socket',
        'cpu_socket',
        'cpu_power_socket',
        'sata15pin',
        'molex4pin',
        'pcie8pin',
        'pcie6pin'
    ];


    public static function getAttributes(): array
    {
        return (new RequiredAttributesForPowerSupply())->prepare();
    }
}
