<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Support\Facades\Auth;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';
    protected $fillable = ['user_id', 'post_id'];
    
    /**
     * リレーション（Userテーブルのidと、user_idを紐づける）
     *
     * @return belongsTo
     */
    public function users(): belongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * リレーション（Tweetテーブルのidとpost_idを紐づける）
     *
     * @return belongsTo
     */
    public function tweets(): belongsTo
    {
        return $this->belongsTo(Tweet::class, 'post_id', 'id');
    }

    /**
     * いいねボタンを押したユーザーのidと投稿IDをLikeテーブルに入れる
     *
     * @param int $userId
     * @param int $tweetId
     *
     * @return void
     */
    public function favorite(int $userId, int $tweetId): void
    {
        $this->user_id = $userId;
        $this->post_id = $tweetId;
        $this->save();
    }

    /**
     * いいねしているかどうかの判別
     *
     * @param int $tweetId
     *
     * @return bool
     */
    public function isFavorite(int $tweetId): bool
    {
        return Like::where([
            ['user_id', Auth::id()],
            ['post_id', $tweetId],
        ])->exists();
    }

    /**
     * いいね解除
     *
     * @param int $tweetId
     *
     * @return void
     */
    public function unlike(int $tweetId): void
    {
        Like::where([
            ['user_id', Auth::id()],
            ['post_id', $tweetId],
        ])->delete();
    }
}
