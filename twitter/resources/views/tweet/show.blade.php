@extends('layouts.master')
@section('title','tweet.details')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card mt-5">
                <div class="card-body p-3 w-100 d-flex ">
                    <div class="ml-2 d-flex flex-column">
                        <p class="mb-0 text-wrap">{{ $tweet->user->name }}</p>
                        <p class="mb-0 text-wrap">{{ $tweet->content }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
