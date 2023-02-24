<?php

namespace App\Core\Components\Diskdrive;

use App\Core\Components\Component;

class DiskDrive extends Component
{
    public readonly string $name;
    public readonly array $attributes;

    public function __construct()
    {
        //TODO:Проконсультироваться касательно проверки совместимости накопителя и остальных комплектующих
        $this->name = 'diskdrive';
        $this->attributes = [
            'volume' => [],
            'socket' => [],
        ];
    }
}
