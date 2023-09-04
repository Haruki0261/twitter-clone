@extends('layouts.master')
@section('title','show')

@section('content')
<div class="row">
    <div class="col-md-offset-1">
        <table class="table text-center">
            <tr>
            <th class="text-center">ID</th>
            <th class="text-center">名前</th>
            <th class="text-center">メールアドレス</th>
            <th class="text-center">入会日</th>
            <th class="text-center">フォロー</th>
            <th class="text-center">フォロワー</th>
            </tr>
            <tr>
            <td>
                {{ $user->id }}
            </td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
            <td><a href="{{ route('followingUser')}}" class="text-reset text-decoration-none">
                {{ $followCount }}</td>
            <td><a href="{{ route('followedUser')}}" class="text-reset text-decoration-none">
                {{ $followedCount }}</td>
                <td>
                <a href="{{ route('user.showEdit') }}" class='btn btn-light'>編集</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">削除</button>
                <a href="{{ route('tweet.showForm') }}" class='btn btn-primary'>投稿</a>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header d-block text-cemter">
                        <h5 class="modal-title" id="exampleModalLabel">メッセージ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        本当に削除しても大丈夫ですか？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                        <a href="{{ route('user.delete') }}" class='btn btn-warning'>削除</a>
                    </div>
                    </div>
                </div>
                </div>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
            <div class="col">
                <div class="card-mb-4 mb-4">
                    @foreach($likeTweets as $likeTweet)
                    <div class="card-header p-3 w-100 d-flex">
                        <div class="ml-2 d-flex flex-column">
                            <p class="mb-0">{{ $likeTweet->tweets->user->name}}</p>
                        </div>
                        <div class="d-flex justify-content-end flex-grow-1">
                            <p class="mb-0">{{ $likeTweet->tweets->updated_at }}</p>
                        </div>
                    </div>
                    <div class="card-body">{{ $likeTweet->tweets->content }}</div>
                    @endforeach
                </div>
            </div>
    </div>
</div>
@endsection

