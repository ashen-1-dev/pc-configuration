<?php

namespace App\Services\Build;

class PowerSupplyFormFactor
{
    public const formFactor =
        [
            'atx' => ['length' => 150, 'width' => 86, 'height' => 140],
            'sfx' => ['length' => 125, 'width' => 51.5, 'height' => 100],
            'eps' => ['length' => 150, 'width' => 86, 'height' => 230],
            'tfx' => ['length' => 85, 'width' => 65.2, 'height' => 175],
            'cfx' => ['length' => 150, 'width' => 86, 'height' => 96],
            'lfx' => ['length' => 62, 'width' => 72, 'height' => 210],
            'flexatx' => ['length' => 40.5, 'width' => 81.5, 'height' => 150],
        ];

    public static function getValue(string $name)
    {
        $name = strtolower($name);
        if (array_key_exists($name, self::formFactor)) {
            return self::formFactor[$name];
        }
    }
}
