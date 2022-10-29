<?php

namespace App\Core\Components;

enum MotherboardFormFactor: string
{
    case ATX = 'atx';
    case microATX = 'microATX';
    case miniITX = 'miniITX';
    case nanoITX = 'nanoITX';
    case picoITX = 'picoITX';
}
