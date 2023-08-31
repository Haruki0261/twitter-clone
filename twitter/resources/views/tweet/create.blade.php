@extends('layouts.master')
@section('title','tweet')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">投稿</div>

                    <div class="card-body">
                        <form action="{{ route('tweet.create') }}" method="post">
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
                                <label for="name">投稿内容</label>
                                <input type="text" class="form-control input-lg" name="content">
                            </div>
                            <button type="submit" class="btn btn-primary float-end">投稿</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
