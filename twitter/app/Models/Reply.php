<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Collection;


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

    /**
     * リプライを作成
     *
     * @param int $authorId
     * @param int $tweetId
     * @param string $content
     *
     * @return void
     */
    public function createReply(int $authorId, int $tweetId, string $content): void
    {
        $this->user_id = $authorId;
        $this->post_id = $tweetId;
        $this->content = $content;
        $this->save();
    }

    /**
     * リプライのデータを全て取得
     *
     * @return Collection
     */
    public function getAllReply(): Collection
    {
        return Reply::all();
    }

    /**
     * Pathパラメータのidと一致したレコードを更新する
     *
     * @param int $replyId
     * @param int $content
     *
     * @return void
     */
    public function updateReply(int $replyId, int $content): void
    {
        $reply = Reply::find($replyId);
        $reply->content = $content;
        $reply->save();
    }
}
