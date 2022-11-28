<?php

namespace App\Core\Components\RequiredAttributes;

class RequiredAttributesForGPU extends RequiredAttributes
{
    public static string $name = 'gpu';
    protected array $attributes = [
        'gpu_memory',
        'gpu_memory_type',
        'vendor',
        'connector',
        'hdmi',
        'vga',
        'display_port',
        'gpu_length'
    ];


    public static function getAttributes(): array
    {
        return (new RequiredAttributesForDiskDrive())->prepare();
    }
}
