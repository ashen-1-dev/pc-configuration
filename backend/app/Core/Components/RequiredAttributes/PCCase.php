<?php

namespace App\Core\Components\RequiredAttributes;

class PCCase extends Component
{
    public static string $name = 'case';
    protected static array $attributes = [
        'form_factor',
        'motherboard_form_factor',
        'max_gpu_length',
        'max_cpu_cooler_height',
    ];
}
