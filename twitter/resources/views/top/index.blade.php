@extends('layouts.master')
@section('title','top')

@section('content')
@auth
<div>
    <a href="{{ route('users.findByUserId', [ 'id' => Auth::id()]) }}">マイページ</a>
</div>
@endauth
@endsection
