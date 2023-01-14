<?php

namespace App\Core\Components\RAM;

enum RAMType: string
{
    case DDR = 'ddr';
    case DDR2 = 'ddr2';
    case DDR3 = 'ddr3';
    case DDR4 = 'ddr4';
    case DDR5 = 'ddr5';
    case SDR = 'sdr';
}
