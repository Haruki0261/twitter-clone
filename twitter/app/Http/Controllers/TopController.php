<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Http\Requests\SearchRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Exception;



class TopController extends Controller
{
    /**
     * トップ画面（Twitterの最初の画面）
     *
     *  @param Tweet $tweet
     *  @param SearchRequest $request
     *
     * @return view|RedirectResponse
     */
    public function index(Tweet $tweet, SearchRequest $request): view|RedirectResponse
    {
        try {
            $search = $request->input('search');
            $tweets = Tweet::all();

            if(!empty($search)){
                $tweets = $tweet->searchByQuery($search);
            }

            return view('top.index', compact('tweets'));
        } catch (Exception $e) {
            logger($e);

            return redirect()->route('top');
        }
    }
}
