<div class="modal-content">
    <span class="modal-close" onclick="closeModal()">&times;</span>

    <div class="modal-row"><span class="modal-label">お名前</span><span class="modal-value">{{ $contact->fullName() }}</span></div>
    <div class="modal-row"><span class="modal-label">性別</span><span class="modal-value">{{ $contact->gender_label }}</span></div>
    <div class="modal-row"><span class="modal-label">メールアドレス</span><span class="modal-value">{{ $contact->email }}</span></div>
    <div class="modal-row"><span class="modal-label">電話番号</span><span class="modal-value">{{ $contact->tel1 }}{{ $contact->tel2 }}{{ $contact->tel3 }}</span></div>
    <div class="modal-row"><span class="modal-label">住所</span><span class="modal-value">{{ $contact->address }}</span></div>
    <div class="modal-row"><span class="modal-label">建物名</span><span class="modal-value">{{ $contact->building }}</span></div>
    <div class="modal-row"><span class="modal-label">お問い合わせ種類</span><span class="modal-value">{{ $contact->category->content }}</span></div>
    <div class="modal-row modal-detail">
        <span class="modal-label">お問い合わせ内容</span>
        <span class="modal-value">{!! nl2br(e($contact->detail)) !!}</span>
    </div>

    <form method="POST" action="{{ route('contacts.destroy', $contact->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
    </form>
</div>