<?php

namespace App\Core\Components\RequiredAttributes;

abstract class RequiredAttributes
{
    protected readonly array $baseAttributes;
    protected array $attributes;
    public static string $name;

    abstract public static function getAttributes(): array;

    public function __construct()
    {
        $this->baseAttributes = [
            'energy_consumption'
        ];
    }

    protected function prepare(): array
    {
        return array_unique(array_merge($this->baseAttributes, $this->attributes));
    }
}
