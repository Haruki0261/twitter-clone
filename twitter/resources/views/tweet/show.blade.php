@extends('layouts.master')
@section('title','tweet.details')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card mt-5">
                <div class="card-header p-3 w-100 d-flex ">
                    <div class="ml-2 d-flex flex-column">
                        <p class="mb-0">{{ $tweet->user->name }}</p>
                    </div>
                    <div class="d-flex justify-content-end flex-grow-1">
                        <p class="mb-0">{{ $tweet->updated_at }}</p>
                    </div>
                </div>
                <div class="card-body">
                    {{ $tweet->content }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
