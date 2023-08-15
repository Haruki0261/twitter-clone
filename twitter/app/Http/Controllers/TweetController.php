<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Http\Requests\TweetRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TweetController extends Controller
{
    /**
     *Tweetモデルのインスタンスを受け取り、プロパティに代入する
     */
    private $tweet;
    public function __construct(Tweet $tweet){
        $this->tweet = $tweet;
    }

    /**
     * 投稿ボタンを押したら、投稿画面に遷移
     *
     * @return view
     */
    public function showTweetForm(): view
    {
        return view('tweet.create');
    }

    /**
     * 投稿者と、投稿内容を取得して、ルーティングを返す
     *
     * @param TweetRequest $request
     *
     * @return RedirectResponse
     */
    public function create(TweetRequest $request): RedirectResponse
    {
        $authorId = Auth::id();
        $content = $request->input('content');
        $this->tweet->create($authorId, $content);

        return redirect()->route('tweets.show');
    }

    /**
     * ツイート詳細画面に遷移
     *
     * @param string $userId
     * @return view
     */
    public function findByTweetId(string $userId): view
    {
        $tweet = $this->tweet->getTweet($userId);

        return view('tweet.show', compact('tweet'));
    }
}
