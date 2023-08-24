<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Follower extends Model
{
    use HasFactory;

    protected $table = 'followers';
    protected $fillable = ['following_id', 'followed_id'];

    /**
     * リレーション（FollowerテーブルのFollowed_idとUserテーブルのidを紐付ける）
     *
     * @return belongsTo
     */
    public function users(): belongsTo
    {
        return $this->belongsTo(User::class, 'followed_id', 'id');
    }


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
    // $userIdの意味がわかりづらい
    public function isFollowing(int $followedUserId): bool
    {
        // followerテーブルを参照
         // followed_idカラムの値と、$userIdが一致するかどうか
        // following_idカラムの値と、ログインユーザーのIDが一致するかどうか
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
    // フォローをしたユーザーのidとフォローをされたユーザーのidを削除する
    // followed_idカラムの値と、Auth::id()一致し、following_idカラムの値と$followedUserIdが一致するカラムを削除する
    public function unFollow(int $followedUserId): void
    {
        Follower::where([
            ['following_id', Auth::id()],
            ['followed_id', $followedUserId],
        ])->delete();
    }

    /**
     * フォローしている人の数を数える
     *
     * @return integer
     */
    public function getFollowCount(): int
    {
        return Follower::where([
            ['following_id', Auth::id()],
        ])->count();
    }

    /**
     * Followテーブルから全てのデータを取得する
     *
     * @return collection
     */
    public function getAllFollowData(): collection
    {
        return Follower::with('users')->get();
    }
}



