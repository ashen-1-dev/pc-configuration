<?php

namespace App\Services;

use App\Http\Controllers\Auth\dto\LoginUserDto;
use App\Http\Controllers\User\dto\CreateUserDto;
use App\Http\Controllers\User\dto\GetUserDto;
use App\Models\User\User;
use Auth;
use Hash;
use Illuminate\Validation\ValidationException;
use Session;

class AuthService
{
    public function login(LoginUserDto $loginUserDto)
    {
        $user = User::where('email', $loginUserDto->email)->first();

        if (!$user || !Hash::check($loginUserDto->password, $user->password)) {
            throw ValidationException::withMessages(['The provided credentials are incorrect.']);
        }
        $token = $user->createToken('frontend')->plainTextToken;
        return ['access_token' => $token];
    }


    public function register(CreateUserDto $createUserDto): GetUserDto
    {
        if (User::where('email', '=', $createUserDto->email)->first() != null) {
            throw ValidationException::withMessages(['user already exists']);
        }
        $createUserDto->password = Hash::make($createUserDto->password);
        $user = User::create($createUserDto->toArray());
        return GetUserDto::from($user);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
    }
}
