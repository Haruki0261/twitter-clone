<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Contracts\View\View;


class TopController extends Controller
{

    /**
     * トップ画面（Twitterの最初の画面）
     *
     * @return view
     */
    public function index()
    {
        $tweets = Tweet::all();

        return view('top.index', compact('tweets'));
    }
}
