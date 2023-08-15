<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Collection;

class Tweet extends Model
{
    use HasFactory;

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
        $tweet->authorId = $authorId;
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
}
