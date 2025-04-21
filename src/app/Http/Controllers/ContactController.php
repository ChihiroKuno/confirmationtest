<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{

    // /**
    //  * 入力フォームの表示
    //  */
    public function index(Request $request)
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    // // /**
    //  * 確認画面
    //  */
    public function confirm(ContactRequest $request)
    {
        $inputs = $request->all();
    $category = Category::find($inputs['category_id']);

    return view('confirm', [
        'inputs' => $inputs,
        'category' => $category
    ]);
    }
    
    public function reinput(Request $request)
    {
    $request->flash(); // セッションに一時保存
    return redirect()->route('index'); // 入力画面にリダイレクト
    }

    // /**
    //  * 送信処理（DB保存）
    //  */
    public function store(ContactRequest $request)
    {
        // confirm.blade.php の formタグから送信された値を受け取る
        $contact = $request->only([
            'last_name' ,
            'first_name' ,
            'gender' ,
            'email' ,
            'tel1' ,
            'tel2' ,
            'tel3' ,
            'address' ,
            'building' ,
            'category_id' ,
            'detail' ,
        ]);
            Contact::create($contact);
            // Contact モデルを使った、データの保存処理のコード。create で$contact の変数に格納されたデータを作成
            return redirect()->route('thanks');
            // お問合せ完了ページに遷移
    }

    public function thanks()
    {
        return view('thanks');
    }
}