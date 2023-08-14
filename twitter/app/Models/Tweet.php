<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Collection;

class Tweet extends Model
{
    use HasFactory;

    protected $table = 'tweets';
    protected $fillable = ['content', 'author_id'];

    /**
     * リレーション（Userテーブルのidカラムと、author_idカラムを紐付けている）
     *
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');

    }

    /**
     * postしてきた内容をデータベースに保存する
     *
     * @param integer $author_id
     * @param string $content
     * @return Tweet
     */
    public function create(int $author_id, string $content): Tweet
    {
        $tweet = new Tweet();
        $tweet->content = $content;
        $tweet->author_id = $author_id;
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
}
