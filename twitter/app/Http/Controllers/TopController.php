<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\Like;
use App\Http\Requests\SearchRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Exception;


class TopController extends Controller
{

    /**
     * トップ画面（Twitterの最初の画面）
     *
     * @param Like $like
     * @param TweetRequest $tweet
     * @param SearchRequest $request
     *
     * @return view|RedirectResponse
     */
    public function index(Like $like, Tweet $tweet, SearchRequest $request): View|RedirectResponse
    {
        try{
            $tweets = Tweet::all();

            $search = $request->input('search');

            $tweets = $tweet->searchByQuery($search);

            foreach($tweets as $tweet){
                $isFavorite =$like->isFavorite($tweet->id);
                $tweet['isFavorite'] = $isFavorite;
            }

            return view('top.index', compact('tweets'));
        }catch (Exception $e){
            Logger($e);

            return redirect()->route('top');
        }
    }
}
