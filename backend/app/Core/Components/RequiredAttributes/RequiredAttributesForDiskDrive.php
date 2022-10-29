<?php

namespace App\Core\Components\RequiredAttributes;

class RequiredAttributesForDiskDrive extends RequiredAttributes
{
    public static string $name = 'diskdrive';
    protected array $attributes = [
        'volume',
        'socket',
    ];


    public static function getAttributes(): array
    {
        return (new RequiredAttributesForDiskDrive())->prepare();
    }
}
