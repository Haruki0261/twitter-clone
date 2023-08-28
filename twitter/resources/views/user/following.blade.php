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
                    @foreach($follows as $follow)
                        @if($follow->following_id == Auth::id())
                            <tr>
                                <td>{{ $follow->users->id }}</td>
                                <td>{{ $follow->users->name }}</td>
                                <td>{{ $follow->users->email }}</td>
                                <td>{{ $follow->users->created_at }}</td>
                            </tr>
                        @endif
                    @endforeach
                </table>
        </div>
    </div>
</div>
@endsection
