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
        return GetUserDto::collection(User::all())->all();
    }

    public function getUser(int $id)
    {
        return GetUserDto::from(User::findOrFail($id));
    }

    public function getAuthUser()
    {
        return GetUserDto::from(Auth::user());
    }

    public function editUser(int $userId, EditUserDto $editUserDto): GetUserDto
    {
        $user = User::findOrFail($userId);
        $user->update(array_filter($editUserDto->toArray()));
        return GetUserDto::from($user);
    }
}
