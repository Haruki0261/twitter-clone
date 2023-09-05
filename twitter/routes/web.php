<?php

use Illuminate\Support\Facades\Auth;
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

//ユーザー関連(フォローも含む)
Route::group(['middleware' => 'auth'], function () {
    //ユーザー詳細画面
    Route::get('/users/{id}',[App\Http\Controllers\UserController::class, 'findByUserId'])->name('users.findByUserId');
    //ユーザー編集画面
    Route::get('/user', [App\Http\Controllers\UserController::class, 'showEdit'])->name('user.showEdit');
    //ユーザー情報を更新した、詳細画面
    Route::put('/user/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    // ユーザー一覧画面
    Route::get('/user/show', [App\Http\Controllers\UserController::class, 'getAll'])->name('users.index');
    // ユーザー削除
    Route::get('/user/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
    //フォローする機能
    Route::post('/user/{id}/follow', [App\Http\Controllers\UserController::class, 'follow'])->name('user.follow');
    //フォロー解除
    Route::delete('/user/{id}/cancelFollow', [App\Http\Controllers\UserController::class, 'unFollow'])->name('user.unFollow');
    //フォローしているユーザーの情報
    Route::get('/user/following', [App\Http\Controllers\UserController::class, 'getFollowingUsers'])->name('followingUser');
    //フォロワーの情報
    Route::get('/user/followed', [App\Http\Controllers\UserController::class, 'getFollowedUsers'])->name('followedUser');
});

//ツイート関連
Route::group(['prefix' => 'tweet', 'as' => 'tweet.', 'middleware' => 'auth'], function (){
    //ツイート投稿画面に遷移
    Route::get('/create', [App\Http\Controllers\TweetController::class, 'showTweetForm'])->name('showForm');
    //ツイート投稿
    Route::post('', [App\Http\Controllers\TweetController::class, 'create'])->name('create');
    //ツイート一覧表示
    Route::get('/show', [App\Http\Controllers\TweetController::class, 'index'])->name('show');
    //ツイート詳細画面に遷移
    Route::get('/{id}/details', [App\Http\Controllers\TweetController::class, 'findByTweetId'])->name('details');
    //ツイートを更新して、ツイート一覧表示に遷移
    Route::put('/{id}/update', [App\Http\Controllers\TweetController::class, 'update'])->name('update');
    //ツイートを削除する
    Route::put('{id}/delete', [App\Http\Controllers\TweetController::class, 'delete'])->name('delete');
    //検索
    Route::get('/search', [App\Http\Controllers\TopController::class, 'index'])->name('query');
    //いいね
    Route::post('/{id}/favorite',  [App\Http\Controllers\TweetController::class, 'favorite'])->name('favorite');
    //いいね解除
    Route::delete('{id}/cancelFollow', [App\Http\Controllers\TweetController::class, 'unlike'])->name('cancelFavorite');
    //リプライ作成ビューに遷移
    Route::get('{id}/showCreateReply', [App\Http\Controllers\TweetController::class, 'showReplyForm'])->name('showReplyForm');
    //リプライ作成
    Route::post('/{id}/createReply', [App\Http\Controllers\TweetController::class, 'createReply'])->name('createReply');
});
