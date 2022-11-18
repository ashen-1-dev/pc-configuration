<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\dto\LoginUserDto;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\dto\CreateUserDto;
use App\Services\AuthService;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class AuthController extends Controller
{
    private readonly AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        try {
            $dto = CreateUserDto::from($request);
            return $this->authService->register($dto);
        } catch (Exception $exception) {
            return $exception;
        }
    }

    public function login(Request $request)
    {
        $loginUserDto = LoginUserDto::from($request);
        return $this->authService->login($loginUserDto);
    }

    public function logout(): void
    {
        $this->authService->logout();
    }
}
