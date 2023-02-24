<?php

namespace App\Http\Controllers\User\dto;

class GetRoleDto extends \Spatie\LaravelData\Data
{
    public string $name;
    public ?string $description;
}
