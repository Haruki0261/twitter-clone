<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Tweet;
use App\Models\Reply;
use App\Http\Requests\TweetRequest;
use App\Http\Requests\PostReplyRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     *Tweetモデルのインスタンスを受け取り、プロパティに代入する
     *Likeモデルのインスタンスを受け取り、プロパティに代入する
     */
    private $tweet;
    private $like;
    private $reply;
    public function __construct(
        Tweet $tweet,
        Like $like,
        Reply $reply
    )
    {
        $this->tweet = $tweet;
        $this->like = $like;
        $this->reply = $reply;
    }

    /**
     * 投稿ボタンを押したら、投稿画面に遷移
     *
     * @return view
     */
    public function showTweetForm(): view
    {
        return view("tweet.create");
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
        $content = $request->input("content");
        $this->tweet->create($authorId, $content);

        return redirect()->route("tweet.show");
    }

    /**
     * トップ画面を表示（ツイート一覧情報を取得して出力）
     *
     * @return view
     */
    public function index(): view
    {
        $tweets = $this->tweet->getAllTweets();

        return view("top.index", compact("tweets"));
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
        $replies = $this->reply->getAllReply();

        return view("tweet.show", compact('tweet', 'replies'));
    }

    /**
     * ツイート編集の情報を受け取リ、モデルに流す。
     *
     * @param TweetRequest $request
     * @param string $userId
     *
     * @return RedirectResponse
     */
    public function update(TweetRequest $request, string $tweetId): RedirectResponse
    {
        try {
            $flashMessage = "ツイート編集に失敗しました。";

            if ($this->isUserPost($tweetId)) {
                $content = $request->input('content');
                $this->tweet->updateTweet($content, $tweetId);

                $flashMessage = 'ツイートが編集されました。';
            }

            return redirect()->route("tweet.show")->with("flashMessage", $flashMessage);
        } catch (Exception $e) {
            logger($e);

            return redirect()->route("tweet.show")->with("flashMessage", "ツイート編集にエラーが発生しました。");
        }
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
     * @param string $tweetId
     *
     * @return RedirectResponse
     */
    public function delete(string $tweetId): RedirectResponse
    {
        try {
            $flashMessage = "ツイート削除に失敗しました。";

            if ($this->isUserPost($tweetId)) {
                $this->tweet->tweetDelete($tweetId);

                $flashMessage = "ツイート削除に成功しました。";
            }

            return redirect()->route("tweet.show")->with("flashMessage", $flashMessage);
        } catch (Exception $e) {
            logger($e);

            return redirect()->route("tweet.show")->with("flashMessage", "ツイート削除にエラーが発生しました。");
        }
    }

    /**
     * いいねを押す
     *
     * @param int $tweetId
     *
     * @return RedirectResponse
     */
    public function favorite(int $tweetId): RedirectResponse
    {
        $userId = Auth::id();
        $this->like->favorite($userId, $tweetId);

        return redirect()->route('top');
    }

    /**
     * いいねを解除する
     *
     * @return RedirectResponse
     */
    public function unlike(int $tweetId)
    {
        $this->like->unlike($tweetId);

        return redirect()->route('top');
    }

    /**
     * リプライ画面に遷移
     *
     * @param int $tweetId
     *
     * @return View
     */
    public function showReplyForm($tweetId): View
    {
        $tweet = $this->tweet->getTweetContent($tweetId);

        return view('tweet.createReply', compact('tweet'));
    }

    /**
     * リプライ作成
     *
     * @param ReplyRequest $request
     * @param int $tweetId
     *
     * @return RedirectResponse
     */
    public function createReply(PostReplyRequest $request, int $tweetId): RedirectResponse
    {
        try {
            $authorId = Auth::id();
            $content = $request->input("content");
            $this->reply->createReply($authorId, $tweetId, $content);

            return redirect()->route('top');
        } catch (Exception $e) {
            logger($e);

            return redirect()->route('top')->with("flashMessage", "リプライ投稿に失敗しました。");
        }
    }
}
