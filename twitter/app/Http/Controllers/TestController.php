<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function ohshima(){
        return view('test');
    }
    
    public function saito() {
        return view('test2');
    }
    
}
