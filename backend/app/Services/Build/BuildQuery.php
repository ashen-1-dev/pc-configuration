<?php

namespace App\Services\Build;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class BuildQuery extends \Spatie\LaravelData\Data
{
    public function __construct(
        public ?int $userId = null,
    )
    {
    }
}
