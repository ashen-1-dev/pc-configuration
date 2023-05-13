<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\dto\EditUserDto;
use App\Services\User\UserService;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private readonly UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function update(Request $request)
    {
        $id = Auth::id();
        $dto = EditUserDto::from($request);
        return response()->json($this->userService->editUser($id, $dto), 200);
    }

    public function index()
    {
        return $this->userService->getUsers();
    }

    public function show(Request $request, int $id)
    {
        return $this->userService->getUser($id);
    }

    public function getAuthUser()
    {
        return $this->userService->getAuthUser();
    }
}

