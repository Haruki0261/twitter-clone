<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TweetRequest;
use App\Models\Tweet;

class TopController extends Controller
{
    private $tweet;

    /**
     * インスタンスの生成
     *
     * @param Tweet
     */
    public function __construct(Tweet $tweet){
        $this->tweet = $tweet;
    }
    /**
     * トップ画面を表示（ツイート一覧情報を取得して出力
     *
     * @return view
     */
    public function index(): view
    {
        $tweets = $this->tweet->getAllTweets();

        return view('top.index', compact('tweets'));
    }

    /**
     * ツイート編集の情報を受け取リ、モデルに流す。
     *
     * @param Request $request
     * @param string $userId
     * @return RedirectResponse
     */
    public function update(TweetRequest $request, string $userId): RedirectResponse
    {
        $content = $request->input('content');
        $update = $this->tweet->updateTweet($content, $userId);

        return redirect()->route('tweets.show');
    }
}
