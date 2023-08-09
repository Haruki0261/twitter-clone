<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**Pathパラメータの'/users/{id}'のIDと一致したレコードのIDを取得
     * 
     * @param string $id
     * @return User
     */
    public function findByUserId(string $userId): User
    {
        return User::findOrFail($userId);
    } 

    /**
     * Pathパラメータの’/user/{id}/update'のIDと一致したレコードのIDを取得
     *
     * @param string $name
     * @param string $email
     * @param string $userId
     * @return User
     */
    public function updateUserById(string $name, string $email, string $userId): User
    {
        $user = User::find($userId);
        $user->name = $name;
        $user->email = $email;
        $user->save();
        return $user;
    }

    /**
     * 全てのユーザーの情報を取得する
     *
     * @return Collection
     */
    public function getAllUser(): Collection
    {
        $users = User::all();
        
        return $users;
    }

    /**
     * ログインしているユーザーのデータを削除する
     *
     * @return void
     */
    public function delete(): void
    {
        User::where('id', Auth::id())->delete();
    }
    
    /**
     * リレーション（Tweetテーブルのauthor_idとUserテーブルのidを紐付けする）
     *
     * @return belongsTo
     */
    public function tweets(): belongsTo
    {
        return $this->belongsTo(Tweet::class, 'author_id', 'id');
    }
}
