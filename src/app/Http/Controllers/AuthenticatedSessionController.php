<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;


class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('login'); 
    }

    public function store(LoginRequest $request)
    {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/admin'); // 管理画面へ
    }

    return back()->withErrors([
        'email' => 'メールアドレスまたはパスワードが正しくありません。',
    ])->withInput();
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
