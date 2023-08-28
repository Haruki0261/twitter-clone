@extends('layouts.master')
@section('title','show')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
                <table class="table text-center">
                    <tr>
                        <th class="text-center">フォローされているユーザーのID</th>
                        <th class="text-center">名前</th>
                        <th class="text-center">メールアドレス</th>
                        <th class="text-center">入会日</th>
                    </tr>
                    @foreach($followers as $follower)
                            <tr>
                                <td>{{ $follower->user->id }}</td>
                                <td>{{ $follower->user->name }}</td>
                                <td>{{ $follower->user->email }}</td>
                                <td>{{ $follower->user->created_at }}</td>
                            </tr>
                    @endforeach
                </table>
        </div>
    </div>
</div>
@endsection
