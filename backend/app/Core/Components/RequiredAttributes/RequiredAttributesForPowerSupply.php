<?php

namespace App\Core\Components\RequiredAttributes;

class RequiredAttributesForPowerSupply extends RequiredAttributes
{
    public static string $name = 'powersupply';
    protected array $attributes = [
        'power',
        'form_factor',
        'cpu_sockets',
        'gpu_sockets',
        'sata15pin',
        'molex4pin',
    ];


    public static function getAttributes(): array
    {
        return (new RequiredAttributesForPowerSupply())->prepare();
    }
}
