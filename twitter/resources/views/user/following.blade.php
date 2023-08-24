@extends('layouts.master')
@section('title','フォローしているユーザー')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
                <table class="table text-center">
                    <tr>
                        <th class="text-center">フォローしているユーザーのID</th>
                        <th class="text-center">名前</th>
                        <th class="text-center">メールアドレス</th>
                        <th class="text-center">入会日</th>
                    </tr>
                    @foreach($followings as $following)
                        @if($following->following_id == Auth::id())
                            <tr>
                                <td>{{ $following->users->id }}</td>
                                <td>{{ $following->users->name }}</td>
                                <td>{{ $following->users->email }}</td>
                                <td>{{ $following->users->created_at }}</td>
                            </tr>
                        @endif
                    @endforeach
                </table>
        </div>
    </div>
</div>
@endsection
