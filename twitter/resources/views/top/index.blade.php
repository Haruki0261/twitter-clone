@extends('layouts.master')
@section('title','top')

@section('content')
@auth
<div>
    <a href="{{ route('users.findByUserId', ['id' => Auth::id()]) }}" class ="btn btn-light">マイページ</a><br>
    <a href="{{ route('users.index')}}" class ="btn btn-light">ユーザー一覧</a>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            @if (session('flashMessage'))
            <div class="flash_message">
                {{ session('flashMessage') }}
            </div>
            @endif
            @foreach ($tweets as $tweet)
                @if($tweet->user)
                <a href="{{ route('tweet.details', ['id' => $tweet->id]) }}" class="text-reset text-decoration-none">
                    <div class="card">
                        <div class="card-body p-3 w-100 d-flex">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0 text-wrap">{{ $tweet->user->name }}</p>
                                <p class="mb-0 text-wrap">{{ $tweet->content }}</p>
                            </div>
                        </div>
                    </div>
                </a>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endauth
@endsection

