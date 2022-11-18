<?php

namespace App\Http\Controllers\User\dto;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Password;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class CreateUserDto extends \Spatie\LaravelData\Data
{
    public function __construct(
        #[Required, Email]
        public string $email,
        #[Required, Password(min: 4)]
        public string $password,
        #[Required, StringType]
        public string $firstName,
        #[Required, StringType]
        public string $lastName,
    )
    {
    }
}
