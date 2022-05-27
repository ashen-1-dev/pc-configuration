<?php

namespace App\Services\Component;

enum NecessaryComponentsEnum: string
{
    case RAM = 'ram';
    case GPU = 'gpu';
    case CPU = 'cpu';
    case DISKDRIVE = 'diskdrive';
    case MOTHERBOARD = 'motherboard';
    case POWERSUPPLY = 'powersupply';
}