@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<h2>Login</h2>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <label>メールアドレス</label>
    <input type="text" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
    @error('email')
    <div class="error"><p style="color: red">{{ $message }}</p></div>
    @enderror

    <label>パスワード</label>
    <input type="password" name="password" placeholder="例: coachtech1106">
    @error('password') <p style="color: red">{{ $message }}</p> @enderror

    <button type="submit"><span>ログイン</span></button>
</form>
@endsection