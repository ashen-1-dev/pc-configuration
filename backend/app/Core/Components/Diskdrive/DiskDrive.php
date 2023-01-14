<?php

namespace App\Core\Components\Diskdrive;

use App\Core\Components\Component;

class DiskDrive extends Component
{
    public readonly string $name;
    public readonly array $attributes;

    public function __construct()
    {
        $this->name = 'diskdrive';
        $this->attributes = [
            'volume' => [],
            'socket' => [],
        ];
    }
}
