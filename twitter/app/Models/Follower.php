<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Follower extends Model
{
    use HasFactory;

    protected $table = 'followers';
    protected $fillable = ['following_id', 'followed_id'];

    /**
     * フォローをしたユーザーのidとフォローをされたユーザーのidをFollowerテーブルに入れる
     *
     * @param [type] $userId
     * @return void
     */
    public function Follow($userId)
    {
        $follower = new Follower();
        $follower->following_id = Auth::id();
        $follower->followed_id = $userId;
        $follower->save();
    }

    /**
     * フォローしているかどうかの判別
     *
     * @param [type] $userId
     * @return boolean
     */
    public function isFollowing($userId)
    {
        $follower = new Follower();

        return $follower->where('followed_id', $userId)->first(['id']);
    }
}



