<?php

namespace App\Core\Components\GPU;

enum DRAMTypes: string
{
    case GDDR = 'gddr';
    case GDDR2 = 'gddr2';
    case GDDR3 = 'gddr3';
    case GDDR4 = 'gddr4';
    case GDDR5 = 'gddr5';
    case GDDR5X = 'gddr5x';
    case GDDR6 = 'gddr6';
}
