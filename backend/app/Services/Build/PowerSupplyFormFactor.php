<?php

namespace App\Services\Build;

class PowerSupplyFormFactor
{
    public const ATX = ['length' => 150, 'width' => 86, 'height' => 140];
    public const SFX = ['length' => 125, 'width' => 51.5, 'height' => 100];
    public const EPS = ['length' => 150, 'width' => 86, 'height' => 230];
    public const TFX = ['length' => 85, 'width' => 65.2, 'height' => 175];
    public const CFX = ['length' => 150, 'width' => 86, 'height' => 96];
    public const LFX = ['length' => 62, 'width' => 72, 'height' => 210];
    public const FlexATX = ['length' => 40.5, 'width' => 81.5, 'height' => 150];

    public static function getValue(string $name)
    {
        if (defined("self::" . $name)) {
            return constant("self::" . $name);
        }
    }
}
