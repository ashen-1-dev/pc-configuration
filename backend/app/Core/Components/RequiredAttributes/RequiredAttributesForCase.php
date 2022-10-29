<?php

namespace App\Core\Components\RequiredAttributes;

class RequiredAttributesForCase extends RequiredAttributes
{
    public static string $name = 'case';
    protected array $attributes = [
        'form_factor',
        'motherboard_form_factor',
        'gpu_length',
        'cpu_cooler_height',
    ];


    public static function getAttributes(): array
    {
        return (new RequiredAttributesForCase())->prepare();
    }
}
