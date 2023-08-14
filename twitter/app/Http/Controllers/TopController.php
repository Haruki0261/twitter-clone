<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
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
}
