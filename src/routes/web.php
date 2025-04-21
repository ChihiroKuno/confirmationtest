<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
// use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// お問い合わせフォーム（入力ページ）
Route::get('/', [ContactController::class, 'index'])->name('index');

// 確認ページ（POSTで送られる）
Route::post('/confirm', [ContactController::class, 'confirm'])->name('confirm');
Route::post('/reinput', [ContactController::class, 'reinput'])->name('form.reinput');

// DB保存（POST）
Route::post('/store', [ContactController::class, 'store'])->name('store');

// サンクスページ
Route::get('/thanks', [ContactController::class, 'thanks'])->name('thanks');


// // Fortify の RegisteredUserController を使わず、自作 RegisterController で統一する
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// // 管理画面（ログイン後のみアクセス可能）
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin'); 
    Route::get('/admin/detail/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');

// モーダル（詳細取得用）
Route::get('/contacts/{id}/detail', [App\Http\Controllers\AdminController::class, 'detail'])->name('contacts.detail');
Route::delete('/contacts/{id}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('contacts.destroy');
});