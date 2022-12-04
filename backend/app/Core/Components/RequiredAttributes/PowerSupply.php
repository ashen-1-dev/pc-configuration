<?php

namespace App\Core\Components\RequiredAttributes;

class PowerSupply extends Component
{
    public static string $name = 'powersupply';
    protected static array $attributes = [
        'power',
        'form_factor',
        'main_socket',
        'cpu_power_socket',
        'sata15pin',
        'molex4pin',
        'pcie8pin',
        'pcie6pin'
    ];
}
