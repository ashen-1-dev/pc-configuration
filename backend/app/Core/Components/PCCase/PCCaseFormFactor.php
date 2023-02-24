<?php

namespace App\Core\Components\PCCase;

class PCCaseFormFactor
{
    public const compatibleMotherboards =
        [
            'supertower' => ['eatx', 'atx', 'microatx', 'miniitx'],
            'fulltower' => ['eatx', 'atx', 'microatx', 'miniitx'],
            'miditower' => ['eatx', 'atx', 'microatx', 'miniitx'],
            'minitower' => ['atx', 'microatx', 'miniitx']
        ];

    public static function getValue(string $name)
    {
        $name = strtolower($name);
        if (array_key_exists($name, self::compatibleMotherboards)) {
            return self::compatibleMotherboards[$name];
        }
    }
}
