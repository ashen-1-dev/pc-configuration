<?php

namespace App\Core\Components\CPU;

use App\Core\Components\Component;
use App\Core\Components\RAM\RAMType;

class CPU extends Component
{
    public readonly array $attributes;
    public readonly string $name;

    public function __construct()
    {
        $this->name = 'cpu';
        $this->attributes = [
            'cors' => [],
            'threads' => [],
            'socket' => [],
            'memory_type' => ['list' => array_column(RAMType::cases(), 'value')],
            'energy_consumption' => []
        ];
    }
}
