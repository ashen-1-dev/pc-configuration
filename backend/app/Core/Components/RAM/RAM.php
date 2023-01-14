<?php

namespace App\Core\Components\RAM;

use App\Core\Components\Component;

class RAM extends Component
{
    public readonly string $name;
    public readonly array $attributes;

    public function __construct()
    {
        $this->name = 'ram';
        $this->attributes = [
            'memory_type' => ['list' => array_column(RAMType::cases(), 'value')],
            'number_of_modules' => ['list' => [1, 2, 3, 4]],
            'frequency' => [],
            'capacity' => [],
        ];
    }
}
//TODO: Разобраться с потреблением энергии,
// с одной стороны, все компоненты потребляют,
// но кроме блока питания,
// получается для него этот атрибут не нужен,
// также непонятно как менеджеру рассчивать
// потребление энергии (как вариант можно заранее подсчитать примерные значения)

