<?php

namespace App\Services;

use App\Http\Controllers\Auth\dto\LoginUserDto;
use App\Http\Controllers\User\dto\CreateUserDto;
use App\Models\User\User;
use Auth;
use Hash;
use Illuminate\Auth\AuthenticationException;
use Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthService
{
    public function login(LoginUserDto $loginUserDto)
    {
        $user = User::where('email', $loginUserDto->email)->first();

        if (!$user || !Hash::check($loginUserDto->password, $user->password)) {
            throw new AuthenticationException();
        }
        $token = $user->createToken('accessToken')->plainTextToken;
        return ['accessToken' => $token];
    }


    public function register(CreateUserDto $createUserDto)
    {
        if (User::where('email', '=', $createUserDto->email)->first() != null) {
            throw new NotFoundHttpException('user already exists');
        }
        $createUserDto->password = Hash::make($createUserDto->password);
        $user = User::create($createUserDto->toArray())->addRole('user');
        if ($createUserDto->photo) {
            $user->addAvatar($createUserDto->photo);
        }

        return ['accessToken' => $user->createToken('accessToken')->plainTextToken];
    }


    public function logout()
    {
        Session::flush();
        Auth::logout();
    }
}
