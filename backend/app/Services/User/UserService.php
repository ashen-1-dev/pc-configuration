<?php

namespace App\Services\User;

use App\Http\Controllers\User\dto\EditUserDto;
use App\Http\Controllers\User\dto\GetUserDto;
use App\Models\User\User;
use Auth;

class UserService
{
    /** @return GetUserDto[] */
    public function getUsers()
    {
        return GetUserDto::collection(User::with(['builds'])->all())->toArray();
    }

    public function getUser(int $id): GetUserDto
    {
        $user = User::with(['builds'])->findOrFail($id);
        return GetUserDto::fromModel($user);
    }

    public function getAuthUser()
    {
        $user = Auth::user()->load(['builds', 'builds.components', 'roles']);
        return GetUserDto::fromModel($user);
    }

    public function editUser(int $userId, EditUserDto $editUserDto): GetUserDto
    {
        $user = User::findOrFail($userId);
        $user->update(array_filter($editUserDto->toArray()));
        if ($editUserDto->photo) {
            $user->addAvatar($editUserDto->photo);
        }

        if ($editUserDto->photo == null) {
            $user->removeAvatar();
        }

        return GetUserDto::fromModel($user->refresh());
    }
}
