<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/haruji',[App\Http\Controllers\TestController::class, 'ohshima']);

Route::get('/haruki', [App\Http\Controllers\TestController::class, 'saito']);

Route::get('/book/{id}',  [App\Http\Controllers\BookController::class, 'show']);

Route::get('/books',  [App\Http\Controllers\BookController::class, 'site']);

//編集画面表示
Route::get('/book/{id}/edit', [App\Http\Controllers\BookController::class, 'next']);

//編集画面（更新処理、登録ボタン）
Route::post('/book/{id}',[App\Http\Controllers\BookController::class, 'update']);

//削除ボタンを押した処理（index.php)
Route::post('/reduce/{id}', [App\Http\Controllers\BookController::class, 'delete']);

//新期登録時の処理
Route::get('/record',[App\Http\Controllers\BookController::class, 'create']);

//新規登録の登録ボタンを押した際の処理
Route::post('/register', [App\Http\Controllers\BookController::class, 'store']);
