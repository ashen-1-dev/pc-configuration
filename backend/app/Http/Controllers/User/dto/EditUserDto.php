<?php

namespace App\Http\Controllers\User\dto;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Image;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class EditUserDto extends \Spatie\LaravelData\Data
{
    public function __construct(
        #[Email]
        public ?string       $email,
        #[StringType]
        public ?string       $firstName,
        #[StringType]
        public ?string       $lastName,
        #[Image]
        public ?UploadedFile $photo,
    )
    {
    }
}
