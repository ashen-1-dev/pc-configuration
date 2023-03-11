<?php

namespace App\Http\Controllers\User\dto;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class GetUserDto extends \Spatie\LaravelData\Data
{
    public function __construct(
        public string          $id,
        public string          $firstName,
        public string          $lastName,
        public string          $email,
        public ?string         $photoUrl,
//        #[DataCollectionOf(GetBuildDto::class)]
//        public ?DataCollection $builds,
        #[DataCollectionOf(GetRoleDto::class)]
        public ?DataCollection $roles
    )
    {
    }

    public static function fromModel(User|Model $user): static
    {
        return static::from($user, [
            'photoUrl' => $user->getAvatarUrl(),
            'roles' => $user->roles,
            'builds' => $user->builds
        ]);
    }
}

