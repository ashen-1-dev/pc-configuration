<?php

namespace App\Http\Controllers\Build\dto;

use App\Http\Controllers\User\dto\GetUserDto;
use Spatie\LaravelData\Optional;

class RawBuildDto extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int|Optional        $id,
        public string|Optional     $name,
        public string|Optional     $description,
        public GetUserDto|Optional $user,
        public array               $componentsIds,
    )
    {
    }
}
