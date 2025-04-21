<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::with('category');

        // 名前検索（部分一致 or 完全一致）
    if ($request->filled('name')) {
        $query->where(function ($q) use ($request) {
            $q->where('first_name', 'like', '%' . $request->name . '%')
              ->orWhere('last_name', 'like', '%' . $request->name . '%');
        });
    }

    // メールアドレス検索（部分一致）
    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->email . '%');
    }

    // 検索条件の名前＋メールを統合するため
    if ($request->filled('keyword')) {
    $query->where(function ($q) use ($request) {
        $q->where('first_name', 'like', '%' . $request->keyword . '%')
          ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
          ->orWhere('email', 'like', '%' . $request->keyword . '%');
    });
    }

    // 性別検索（全て以外を選んだとき）
    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }

    // カテゴリ検索
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // 日付検索
    if ($request->filled('search_date')) {
        $query->whereDate('created_at', $request->search_date);
    }
    // ページネーション withQueryString()はpaginate() の直後に使うと 検索条件をページ送りのリンクに引き継いでくれる
    $contacts = $query->orderBy('created_at', 'desc')->paginate(7)->withQueryString();
    $categories = Category::all();

    return view('admin', compact('contacts', 'categories'));
    }
    // モーダル関係
    public function detail($id)
    {
        $contact = Contact::with('category')->findOrFail($id);

        return response()->json([
            'html' => view('partials.contact-detail', compact('contact'))->render()
        ]);
    }

    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin')->with('success', '削除しました');
    }

    // エクスポート
    public function export(Request $request): StreamedResponse
    {
        $query = Contact::with('category');

        // 検索条件の再適用（index()と同じ）
        if ($request->filled('name')) {
            $query->where('first_name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('search_date')) {
            $query->whereDate('created_at', $request->search_date);
        }

        $contacts = $query->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ];

        $callback = function () use ($contacts) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', '名前', 'メール', '性別', 'お問い合わせ種別', '登録日']);

            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->id,
                    $contact->fullName(),
                    $contact->email,
                    $contact->gender_label,
                    $contact->category->content,
                    $contact->created_at->format('Y-m-d'),
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
