<?php

namespace App\Core\Components\PCCase;

use App\Core\Components\Component;

class PCCase extends Component
{
    public readonly string $name;
    public readonly array $attributes;

    public function __construct()
    {
        $this->name = 'case';
        $this->attributes = [
            'form_factor' => [],
            'motherboard_form_factor' => [],
            'max_gpu_length' => [],
            'max_cpu_cooler_height' => [],
        ];
    }
}
