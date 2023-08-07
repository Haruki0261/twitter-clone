<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\TopController::class, 'index'])->name('top');

Auth::routes();
Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {
// ユーザー詳細画面
    Route::get('/users/{id}',[App\Http\Controllers\UserController::class, 'findByUserId'])->name('users.findByUserId');

// ユーザー編集画面
    Route::get('/user', [App\Http\Controllers\UserController::class, 'showEdit'])->name('user.showEdit');

// ユーザー情報を更新した、詳細画面
    Route::put('/user/{id}/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

// ユーザー一覧画面
    Route::get('/user/show', [App\Http\Controllers\UserController::class, 'getAll'])->name('users.index');

});
