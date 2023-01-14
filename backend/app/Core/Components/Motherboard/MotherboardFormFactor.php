<?php

namespace App\Core\Components\Motherboard;

class MotherboardFormFactor
{
    public const formFactor =
        [
            'atx' => ['length' => 305, 'width' => 244],
            'eatx' => ['length' => 305, 'width' => 330],
            'microatx' => ['length' => 244, 'width' => 244],
            'miniatx' => ['length' => 284, 'width' => 208],
            'miniitx' => ['length' => 170, 'width' => 170],
            'picoitx' => ['length' => 100, 'width' => 72],
            'flexatx' => ['length' => 229, 'width' => 244],
            'at' => ['length' => 305, 'width' => 330],
            'xt' => ['length' => 216, 'width' => 279],
        ];

    public static function getValue(string $name)
    {
        $name = strtolower($name);
        if (array_key_exists($name, self::formFactor)) {
            return self::formFactor[$name];
        }
    }
}

