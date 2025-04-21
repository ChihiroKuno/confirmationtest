@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>Confirm</h2>

    <table>
        <tr><th>お名前</th><td>{{ $inputs['last_name'] }} {{ $inputs['first_name'] }}</td></tr>
        <tr><th>性別</th><td>
            @php
                $gender = ['1' => '男性', '2' => '女性', '3' => 'その他'][$inputs['gender']];
            @endphp
            {{ $gender }}
        </td></tr>
        <tr><th>メールアドレス</th><td>{{ $inputs['email'] }}</td></tr>
        <tr><th>電話番号</th><td>{{ $inputs['tel1'] . $inputs['tel2'] . $inputs['tel3'] }}</td></tr>
        <tr><th>住所</th><td>{{ $inputs['address'] }}</td></tr>
        <tr><th>建物名</th><td>{{ $inputs['building'] }}</td></tr>
        <tr><th>お問い合わせの種類</th><td>{{ $category->content }}</td></tr>
        <tr><th>お問い合わせ内容</th><td>{{ $inputs['detail'] }}</td></tr>
    </table>

    <!-- ボタン -->
    <div class="button-wrapper">
        {{-- 送信ボタン --}}
        <form method="POST" action="{{ route('store') }}">
            @csrf
            @foreach ($inputs as $name => $value)
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endforeach
            <button type="submit" class="button-link button-active">送信</button>
        </form>

        {{-- 修正ボタン --}}
        <form method="POST" action="{{ route('form.reinput') }}">
            @csrf
            @foreach ($inputs as $name => $value)
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endforeach
            <button type="submit" class="button-link button-inactive">修正</button>
        </form>
    </div>
</div>
@endsection