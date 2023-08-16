<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tweet extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tweets';
    protected $fillable = ['content', 'author_id'];

    /**
     * リレーション（Userテーブルのidカラムと、author_idカラムを紐付けている）
     *
     * @return belongsTo
     */
    public function user(): belongsTo
    {
        return $this->belongsTo(User::class, 'author_id' , 'id');
    }

    /**
     * postしてきた内容をデータベースに保存する
     *
     * @param integer $author_id
     * @param string $content
     * @return Tweet
     */
    public function create(int $authorId, string $content): Tweet
    {
        $tweet = new Tweet();
        $tweet->content = $content;
        $tweet->author_id = $authorId;
        $tweet->save();

        return $tweet;
    }

    /**
     * ツイートテーブルから情報を取得する
     *
     * @return　Collection
     */
    public function getAllTweets(): Collection
    {
        $tweets = Tweet::with('user')->get();

        return $tweets;
    }

    /**
     *　Pathパラメータの'/users/{id}'のIDと一致したレコードを取得
     *
     * @param string $userId
     * @return  Tweet
     */
    public function getTweet(string $userId): Tweet
    {
        $tweet = Tweet::find($userId);

        return $tweet;
    }

    /**
     * Pathパラメータの’/{id}/update'のIDと一致したレコードを更新する
     *
     * @param string $content
     * @param string $userId
     * @return Tweet
     */
    public function updateTweet(string $content, string $userId): Tweet
    {
        $tweet = Tweet::find($userId);
        $content = $tweet->content = $content;
        $tweet->save();

        return $tweet;
    }


    /**
     * 投稿したツイートのidを見つけて、ツイートを削除する。
     *
     * @param string $tweetId
     *
     * @return void
     */
    public function tweetDelete(string $tweetId)
    {
        Tweet::find($tweetId)->delete();
    }
}
