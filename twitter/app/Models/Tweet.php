<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
     * リレーション（Likeテーブルのpost_idカラムと、idを紐づけている）
     *
     * @return hasMany
     */
    public function likes(): hasMany
    {
        return $this->hasMany(Like::class, 'post_id' , 'id');
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
     * @return Collection
     */
    public function getAllTweets(): Collection
    {
        $tweets = Tweet::with('user')->get();

        return $tweets;
    }

    /**
     * Pathパラメータの'/users/{id}'のIDと一致したレコードを取得
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
        $tweet->content = $content;
        $tweet->save();

        return $tweet;
    }

    /**
     * ＄tweetIdに一致したデータを削除する
     *
     * @param string $tweetId
     *
     * @return void
     */
    public function tweetDelete(string $tweetId): void
    {
        Tweet::find($tweetId)->delete();
    }

    /**
     * 検索ワードと部分一致（LIKE検索）した投稿内容を取得
     *
     * @param ?string $keyword
     *
     * @return collection
     */
    public function searchByQuery(?string $search): Collection
    {
        $query = Tweet::query();

        if(!empty($search)){
            $searchSplit = mb_convert_kana($search, "s");
            $wordArraySearched = preg_split('/[\s]+/', $searchSplit, -1, PREG_SPLIT_NO_EMPTY);

            foreach($wordArraySearched as $value){
                $query->where("content", "LIKE", "%{$value}%");
            }
        }
        $tweets = $query->get();

        return $tweets;
    }
}
