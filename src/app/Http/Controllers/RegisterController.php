<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(RegisterUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user); // ログイン後に

        return redirect()->intended('/admin'); // 管理画面へリダイレクト
    }
}