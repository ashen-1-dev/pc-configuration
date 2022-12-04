<?php

namespace App\Core\Components\RequiredAttributes;

class CPU extends Component
{
    public static string $name = 'cpu';
    protected static array $attributes = [
        'cors',
        'threads',
        'socket',
        'memory_type',
        'energy_consumption'
    ];
}
