<?php

namespace App\Core\Components\RequiredAttributes;

class RequiredAttributesForRAM extends RequiredAttributes
{
    public static string $name = 'ram';
    protected array $attributes = [
        'memory_type',
        'number_of_modules',
        'frequency',
        'capacity',
    ];

    public static function getAttributes(): array
    {
        return (new RequiredAttributesForRAM())->prepare();
    }
}
//TODO: Разобраться с потреблением энергии, с одной стороны, все компоненты потребляют, но кроме блока питания, получается для него этот атрибут не нужен, также непонятно как менеджеру рассчивать потребление энергии (как вариант можно заранее подсчитать примерные значения)

