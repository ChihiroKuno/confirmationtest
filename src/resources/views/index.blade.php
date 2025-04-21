@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>Contact</h2>
    <form method="POST" action="{{ route('confirm') }}">
        @csrf

        {{-- お名前 --}}
<div>
    <label data-required="※">お名前</label>
    <div class="name-group">
        <div>
            <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
            @error('last_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
            @error('first_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div>
            <label data-required="※">性別</label>
            <div class="radio-group">
                <label><input type="radio" name="gender" value="1" {{ old('gender', 1) == 1 ? 'checked' : '' }}><span>男性</span></label>
                <label><input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}><span>女性</span></label>
                <label><input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}><span>その他</span></label>
            </div>
            @error('gender')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        {{-- メールアドレス --}}
        <div>
            <label data-required="※">メールアドレス</label>
            <div style="flex: 1;">
                <input type="text" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                @error('email')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>

        {{-- 電話番号 --}}
        <div>
            <label data-required="※">電話番号</label>
            <div style="flex: 1;">
                <div class="tel-group">
                    <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}" maxlength="5"> -
                    <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}" maxlength="5"> -
                    <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}" maxlength="5">
                </div>
                @error('tel1')<div class="text-danger">{{ $message }}</div>@enderror
                @error('tel2')<div class="text-danger">{{ $message }}</div>@enderror
                @error('tel3')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>

        {{-- 住所 --}}
        <div>
            <label data-required="※">住所</label>
            <div style="flex: 1;">
                <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                @error('address')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>

        {{-- 建物名（任意） --}}
        <div>
            <label>建物名</label>
            <div style="flex: 1;">
                <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
            </div>
        </div>

        {{-- お問い合わせの種類 --}}
<div>
    <label data-required="※">お問い合わせの種類</label>
    <div class="half-width">
        <select name="category_id">
            <option value="">選択してください</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
            @endforeach
        </select>
        @error('category_id')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
</div>

        {{-- お問い合わせ内容 --}}
        <div>
            <label data-required="※">お問い合わせ内容</label>
            <div style="flex: 1;">
                <textarea name="detail" placeholder="お問い合わせ内容をご記載ください" rows="5">{{ old('detail') }}</textarea>
                @error('detail')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>

        {{-- 送信ボタン --}}
        <div class="button-wrapper">
            <button type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection