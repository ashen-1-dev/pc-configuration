<?php

namespace App\Core\Components\GPU;

use App\Core\Components\Component;

class GPU extends Component
{
    public readonly string $name;
    public readonly array $attributes;

    public function __construct()
    {
        $this->name = 'gpu';
        $this->attributes = [
            'gpu_memory' => [],
            'gpu_memory_type' => ['list' => array_column(DRAMTypes::cases(), 'value')],
            'vendor' => [],
            'connector' => [],
            'hdmi' => [],
            'vga' => [],
            'display_port' => [],
            'gpu_length' => [],
            'energy_consumption' => []
        ];
    }
}
