@extends('layouts.app')

<style>

svg.w-5.h-5 {
    /*paginateメソッドの矢印の大きさ調整のために追加*/
    width: 30px;
    height: 30px;
}

</style>

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<h2>Admin</h2>

<!-- 検索フォーム -->
<form method="GET" action="{{ route('admin') }}" class="search-form">
    <div class="form-row">
    <input type="text" name="keyword" class="input-wide" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">
        <select name="gender">
            <option value="">性別</option>
            <option value="1" {{ request('gender') == 1 ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == 2 ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == 3 ? 'selected' : '' }}>その他</option>
        </select>

        <select name="category_id">
            <option value="">お問い合わせの種類</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
            @endforeach
        </select>

        <input type="date" name="search_date" value="{{ request('search_date') }}">

        <button type="submit">検索</button>
        <a href="{{ route('admin') }}">リセット</a>
    </div>
</form>

<!-- エクスポートボタン -->
<div class="export-btn">
    <a href="{{ route('admin.export', request()->query()) }}">エクスポート</a>
</div>

<!-- ページネーション -->
<div class="pagination">
{{ $contacts->links('vendor.pagination.default') }}
</div>

<!-- テーブル -->
<table>
    <thead>
        <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($contacts as $contact)
        <tr>
            <td>{{ $contact->fullName() }}</td>
            <td>{{ $contact->gender_label }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->category->content }}</td>
            <td>
                <button data-id="{{ $contact->id }}" class="modal-btn">詳細</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- モーダル -->
<div id="modal" style="display:none;"></div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.modal-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;

            fetch(`/contacts/${id}/detail`)
                .then(response => response.json())
                .then(data => {
                    const modal = document.getElementById('modal');
                    modal.innerHTML = data.html;
                    modal.style.display = 'block';
                });
        });
    });
});

function closeModal() {
    document.getElementById('modal').style.display = 'none';
}
</script>
@endsection