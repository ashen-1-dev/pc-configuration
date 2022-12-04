<?php

namespace App\Core\Components\RequiredAttributes;

class GPU extends Component
{
    public static string $name = 'gpu';
    protected static array $attributes = [
        'gpu_memory',
        'gpu_memory_type',
        'vendor',
        'connector',
        'hdmi',
        'vga',
        'display_port',
        'gpu_length',
        'energy_consumption'
    ];
}
