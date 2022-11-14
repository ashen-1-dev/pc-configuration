<?php

namespace App\utils\transformers;

use Spatie\LaravelData\Support\DataProperty;
use URL;

class InsertDomainUrl implements \Spatie\LaravelData\Transformers\Transformer
{

    public function transform(DataProperty $property, mixed $value): mixed
    {
        return URL::to('/') . $value;
    }
}
