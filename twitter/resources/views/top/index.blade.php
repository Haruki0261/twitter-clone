@extends('layouts.master')
@section('title','top')

@section('content')
@auth
<div>
    <a href="{{ route('users.findByUserId', ['id' => Auth::id()]) }}" class ="btn btn-light">マイページ</a><br>
    <a href="{{ route('users.index') }}" class ="btn btn-light">ユーザー一覧</a>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            @if (session('flashMessage'))
            <div class="flash_message">
                {{ session('flashMessage') }}
            </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-7">
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-md-offset-1">
                    <form action="{{ route('tweet.query') }}" method="get">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-light btn-outline-primary">検索</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @foreach($tweets as $tweet)
                @if($tweet->user)
                <a href="{{ route('tweet.details', ['id' => $tweet->id]) }}" class="text-reset text-decoration-none">
                    <div class="card">
                        <div class="card-body p-3 w-100 d-flex">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0 text-wrap">{{ $tweet->user->name }}</p>
                                <p class="mb-0 text-wrap">{{ $tweet->content }}</p>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="d-flex justify-content-end">
                                @if(!$tweet->isFavorite)
                                    @if($tweet->author_id != Auth::id())
                                        <form method="POST" action="{{ route('tweet.favorite', ['id' => $tweet->id]) }}"  class="mb-0">
                                            @csrf
                                            <button type="submit" class="btn p-0 border-0"><i class="far fa-heart fa-fw"></i></button>
                                        </form>
                                        <p>{{ $tweet->favoriteCount }}</p>
                                    @endif
                                @else
                                    <form method="post" action="{{ route('tweet.cancelFavorite', ['id' => $tweet->id]) }}"  class="mb-0">
                                        @method("delete")
                                        @csrf
                                        <button type="submit" class="btn p-0 border-0" ><i class="fa-solid fa-heart fa-fw"></i></button>
                                    </form>
                                    <p>{{ $tweet->favoriteCount }}</p>
                                @endif
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

