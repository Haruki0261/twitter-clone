<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * インスタンスの生成
     *
     * @var [User]
     */
    private $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
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
        $user = auth()->user();
        return view('user.edit', compact('user'));
    }

    /**
     *ユーザー情報更新
     *
     * @param UpdateUserRequest $request
     * @param string $userId
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
}
