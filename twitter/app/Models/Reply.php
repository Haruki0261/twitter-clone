<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Reply extends Model
{
    use HasFactory;

    protected $table = 'reply';
    protected $fillable = ['user_id', 'post_id', 'content'];
    /**
     * リレーション（Userテーブルのidと、Replyテーブルのuser_idを紐づける）
     *
     * @return belongsTo
     */
    public function User(): belongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * リレーション（Tweetテーブルのidと、Replyテーブルのpost_idを紐づける）
     *
     * @return belongsTo
     */
    public function Tweet(): belongsTo
    {
        return $this->belongsTo(Tweet::class, 'post_id', 'id');
    }

    public function createReply($authorId, $tweetId, $content)
    {
        $this->user_id = $authorId;
        $this->post_id = $tweetId;
        $this->content = $content;
        $this->save();
    }
}

