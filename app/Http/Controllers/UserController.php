<?php

namespace App\Http\Controllers;

use App\Models\Users\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function show()
    {
        $builds = Auth::user()->builds;
        return view('user.profile', compact('builds'));
    }


    public function register(Request $request)
    {
        if(User::where('email', '=', $request->email)->first() != null)
            return response()->json(
                [
                    'success' => false,
                    'data' => 'User already exist'
                ]
            );
        $data = $request->validate(
            [
                'first_name' => ['required'],
                'last_name' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        $user->save();
        return view('user.profile');
//        return response()->json(
//            [
//                'success' => true,
//                'data' => $data,
//            ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

        if (Auth::attempt($credentials)) {
            $user = User::where('email', '=', $credentials['email'])->first();
            Auth::login($user);
            return redirect()->route('profile');
        }

        return response()->json(
            [
                'success' => false,
                'data' => 'Failed login'
            ]);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('welcome');
    }
}
