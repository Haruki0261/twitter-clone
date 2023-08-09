<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function createPost(int $author_id, string $content): Tweet
    {
        $tweet = new Tweet();
        $tweet->content = $content;
        $tweet->author_id = $author_id;
        $tweet->save();
        
        return $tweet;
    }
}
