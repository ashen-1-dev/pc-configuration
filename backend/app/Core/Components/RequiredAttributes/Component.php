<?php

namespace App\Core\Components\RequiredAttributes;

abstract class Component
{
    protected static array $attributes;
    public static string $name;

    public static function getAttributes()
    {
        return static::$attributes;
    }
}
