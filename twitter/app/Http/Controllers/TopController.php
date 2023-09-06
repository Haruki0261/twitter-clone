<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Tweet;
use App\Http\Requests\SearchRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;




class TopController extends Controller
{
    /**
     * トップ画面（Twitterの最初の画面）
     *
     *  @param Like $like
     *  @param Tweet $tweet
     *  @param SearchRequest $request
     *
     * @return view|RedirectResponse
     */
    public function index(
        Like $like,
        Tweet $tweet,
        SearchRequest $request
    ): view | RedirectResponse
    {
        try {
            $search = $request->input('search');
            $tweets = Tweet::all();

            if(!empty($search)){
                $tweets = $tweet->searchByQuery($search);
            }

            foreach ($tweets as $tweet) {
                $tweet['isFavorite'] =  $like->isFavorite($tweet->id);
                $tweet['favoriteCount'] = $like->countMyPostLikes($tweet->id);
            }
            return view('top.index', compact('tweets'));
        } catch (Exception $e) {
            logger($e);

            return redirect()->route('users.index');
        }
    }
}
