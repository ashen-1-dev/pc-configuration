<?php

namespace App\Core\Components;

enum RequiredComponentsForBuild: string
{
    case RAM = 'ram';
    case GPU = 'gpu';
    case CPU = 'cpu';
    case DISKDRIVE = 'diskdrive';
    case MOTHERBOARD = 'motherboard';
    case POWERSUPPLY = 'powersupply';
    case CASE = 'case';
}
