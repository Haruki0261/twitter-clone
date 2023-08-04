<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
     *
     * @param string $id
     * @return User
     */
    public function findByUserId(string $id): User
    {
        return User::findOrFail($id);
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
}
