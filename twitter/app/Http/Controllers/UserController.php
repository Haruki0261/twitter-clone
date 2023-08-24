<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Follower;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;



class UserController extends Controller
{
    /**
     * インスタンスの生成
     */
    private $user;
    private $follower;

    public function __construct(User $user, Follower $follower)
    {
        $this->user = $user;
        $this->follower = $follower;

    }

    /**
     * ユーザー詳細画面を表示します。
     *
     * @param string $id
     * @return RedirectResponse|View
     */
    public function findByUserId(string $id): RedirectResponse|View
    {
        if(Auth::id() !== (int)$id){
            return redirect()->route('top');
        }
        $user = $this->user->findByUserId($id);

        return view('user.show', compact('user'));
    }

    /**
     * ユーザー編集画面に遷移します。
     *
     * @return view
     */
    public function showEdit(): view
    {
        $user = auth()->user();//認証しているユーザーの情報

        return view('user.edit', compact('user'));
    }

    /**
     *ユーザー情報更新
     *
     * @param UpdateUserRequest $request
     * @param string $userId
     *
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, string $userId): RedirectResponse
    {
        $user = User::find($userId);
        $name = $request->input('name');
        $email = $request->input('email');
        $user->updateUserById($name, $email, $userId);

        return redirect()->route('users.findByUserId', ['id' => $userId]);
    }

    /**
     * ユーザー情報一覧表示
     *
     * @return view
     */
    public function getAll(): view
    {
        $users = $this->user->getAllUser();
        foreach($users as $user){
            $isFollowing = $this->follower->isFollowing($user->id);
            $user['isFollowing'] = $isFollowing;
            }

        return view('user.index', compact('users'));
    }

    /**
     * ユーザー情報削除
     *
     * @return RedirectResponse
     */
    public function delete(): RedirectResponse
    {
        $this->user->delete();

        return redirect()->route('top');
    }

    /**
     * フォローする
     *
     * @param int $userId
     *
     * @return RedirectResponse
     */
    public function follow(int $followedUserId): RedirectResponse
    {
        // isFollowing()がtrue → フォローしてる
        // isFollowing()がfalse → フォローしてない
        // if(!$isFollowing){
            $this->follower->follow($followedUserId);

            return redirect()->route('users.index');
    }

    /**
     * フォロー解除する
     *
     * @param int $followedUserId
     *
     * @return RedirectResponse
     */
    public function unFollow(int $followedUserId): RedirectResponse
    {
        $this->follower->unFollow($followedUserId);

        return redirect()->route('users.index');
    }
}

