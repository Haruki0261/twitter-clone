@extends('layouts.master')
@section('title','top')

@section('content')
@auth
<div>
    <a href="{{ route('users.findByUserId', [ 'id' => Auth::id()]) }}" class ="btn btn-light">マイページ</a><br>
    <a href="{{ route('users.index')}}" class ="btn btn-light">ユーザー一覧</a>
</div>
@endauth
@endsection
