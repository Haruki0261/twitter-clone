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
     * @param int $userId
     *
     * @return void
     */
    public function Follow(int $userId): void
    {
        $follower = new Follower();
        $follower->following_id = Auth::id();
        $follower->followed_id = $userId;
        $follower->save();
    }

    /**
     * フォローしているかどうかの判別
     *
     * @param int $userId
     *
     * @return boolean
     */
    public function isFollowing(int $followedUserId): bool
    {
        return Follower::where([
            ['following_id', Auth::id()],
            ['followed_id', $followedUserId],
            ])->exists();
    }


    /**
     *  フォローをしたユーザーのidとフォローをされたユーザーのidを削除する
     *
     * @param int $followedUserId
     *
     * @return void
     */
    public function unFollow(int $followedUserId): void
    {
        Follower::where([
            ['following_id', Auth::id()],
            ['followed_id', $followedUserId],
        ])->delete();
    }
}



