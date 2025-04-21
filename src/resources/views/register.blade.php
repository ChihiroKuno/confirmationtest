@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<h2>Register</h2>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <label>お名前</label>
    <input type="text" name="name" placeholder="例: 山田 太郎" value="{{ old('name') }}">
    @error('name') <p>{{ $message }}</p> @enderror

    <label>メールアドレス</label>
    <input type="text" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
    @error('email')
    <div class="error"><p style="color: red">{{ $message }}</p></div>
    @enderror

    <label>パスワード</label>
    <input type="password" name="password" placeholder="例: coachtech1106">
    @error('password') <p>{{ $message }}</p> @enderror

    <button type="submit"><span>登録</span></button>
</form>
@endsection