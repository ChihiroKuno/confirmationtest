@extends('layouts.app')

@section('header')
<!-- thanksページではヘッダーを非表示 -->
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="container text-center">
    <p class="text-lg mb-4">お問い合わせありがとうございました</p>

    <a href="{{ route('index') }}">
        <button class="home-button">HOME</button>
    </a>
</div>
@endsection