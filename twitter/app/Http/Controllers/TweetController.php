<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Http\Requests\TweetRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class TweetController extends Controller
{
    /**
     *Tweetモデルのインスタンスを受け取り、プロパティに代入する
     */
    private $tweet;
    public function __construct(Tweet $tweet)
    {
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
     * トップ画面を表示（ツイート一覧情報を取得して出力）
     *
     * @return view
     */
    public function index(): view
    {
        $tweets = $this->tweet->getAllTweets();

        return view('top.index', compact('tweets'));
    }

    /**
     * ツイート詳細画面に遷移
     *
     * @param string $userId
     *
     * @return view
     */
    public function findByTweetId(string $userId): view
    {
        $tweet = $this->tweet->getTweet($userId);

        return view('tweet.show', compact('tweet'));
    }

    /**
     * ツイート編集の情報を受け取リ、モデルに流す。
     *
     * @param TweetRequest $request
     * @param string $userId
     *
     * @return RedirectResponse
     */
    public function update(TweetRequest $request, string $userId): RedirectResponse
    {
        $content = $request->input('content');
        $update = $this->tweet->updateTweet($content, $userId);

        return redirect()->route('tweets.show');
    }

    /**
     * 投稿者と認証中の人間が一致しているかどうか判断する
     *
     * @param string $tweetId
     *
     * @return bool
     */
    public function isUserPost(string $tweetId): bool
    {
        $tweet = $this->tweet->getTweet($tweetId);

        return $tweet->author_id === Auth::id();
    }

    /**
     * もし投稿者と認証中の人間が一致していたら、削除処理を行う
     *
     * @param [type] $tweetId
     * @return void
     */
    public function delete($tweetId)
    {
        try {
            if ($this->isUserPost($tweetId)) {
                $this->tweet->tweetDelete($tweetId);
            }
        } catch (Exception $e) {
            return redirect()->route('tweets.show')->with('flashMassage', "ツイート削除に失敗しました。");
        }
        return redirect()->route('tweets.show')->with('flashMessage', 'ツイートが削除されました。');
    }
}
