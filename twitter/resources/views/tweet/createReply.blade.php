@extends('layouts.master')
@section('title','commnet')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-3 w-100 d-flex">
                <div class="ml-2 d-flex flex-column">
                    <p class="mb-0 text-wrap">{{ $tweet->user->name }}</p>
                    <p class="mb-0 text-wrap">{{ $tweet->content }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">コメント</div>
                    <div class="card-body">
                        <form action="{{ route("tweet.createReply", ['id' => $tweet->id]) }}" method="post">
                            @csrf
                            <div class="form-group form-group-lg">
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
                                <label for="name">コメント</label>
                                <input type="text" class="form-control input-lg" name="content">
                            </div>
                            <button type="submit" class="btn btn-primary float-end">送信</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
