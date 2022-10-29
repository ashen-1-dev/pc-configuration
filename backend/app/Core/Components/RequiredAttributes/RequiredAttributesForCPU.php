<?php

namespace App\Core\Components\RequiredAttributes;

class RequiredAttributesForCPU extends RequiredAttributes
{
    public static string $name = 'cpu';
    protected array $attributes = [
        'cors',
        'threads',
        'socket',
        'memory_type',
    ];

    public static function getAttributes(): array
    {
        return (new RequiredAttributesForCPU())->prepare();
    }
}
