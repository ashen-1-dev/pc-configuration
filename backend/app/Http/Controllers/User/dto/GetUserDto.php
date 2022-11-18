<?php

namespace App\Http\Controllers\User\dto;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class GetUserDto extends \Spatie\LaravelData\Data
{
    public function __construct(
        public string $id,
        public string $firstName,
        public string $lastName,
        public string $email,
        //FIXME: add builds when create build dto
    )
    {
    }
}
