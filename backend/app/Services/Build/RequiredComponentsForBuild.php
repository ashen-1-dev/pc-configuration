<?php

namespace App\Services\Build;

enum RequiredComponentsForBuild: string
{
    case RAM = 'ram';
    case GPU = 'gpu';
    case CPU = 'cpu';
//    FIXME: Расскоментировать, когда будет релизован чекер для накопителя
//    case DISKDRIVE = 'diskdrive';
    case MOTHERBOARD = 'motherboard';
    case POWERSUPPLY = 'powersupply';
    case CASE = 'case';
}
