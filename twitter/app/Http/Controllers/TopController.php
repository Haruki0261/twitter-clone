<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\Like;
use App\Http\Requests\SearchRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Exception;



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
    public function index(Like $like, Tweet $tweet, SearchRequest $request): view|RedirectResponse
    {
        try {
            $search = $request->input('search');
            $tweets = Tweet::all();

            if(!empty($search)){
                $tweets = $tweet->searchByQuery($search);
            }

            foreach ($tweets as $tweet) {
                $isFavorite = $like->isFavorite($tweet->id);
                $tweet['isFavorite'] = $isFavorite;
            }

            return view('top.index', compact('tweets'));
        } catch (Exception $e) {
            logger($e);

            return redirect()->route('top');
        }
    }
}
