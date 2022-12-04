<?php

namespace App\Http\Controllers\Build\dto;

use App\Http\Controllers\User\dto\GetUserDto;

class RawBuildDto extends \Spatie\LaravelData\Data
{
    public function __construct(
        public ?int        $id,
        public ?string     $name,
        public ?string     $description,
        public ?GetUserDto $user,
        public array       $componentsIds,
    )
    {
    }
}
