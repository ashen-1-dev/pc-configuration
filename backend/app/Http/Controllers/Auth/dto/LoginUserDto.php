<?php

namespace App\Http\Controllers\Auth\dto;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Required;

class LoginUserDto extends \Spatie\LaravelData\Data
{
    public function __construct(
        #[Required, Email]
        public string $email,
        #[Required]
        public string $password
    )
    {
    }
}
