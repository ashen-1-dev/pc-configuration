<?php

namespace App\Core\Components\RequiredAttributes;

class DiskDrive extends Component
{
    public static string $name = 'diskdrive';
    protected static array $attributes = [
        'volume',
        'socket',
    ];
}
