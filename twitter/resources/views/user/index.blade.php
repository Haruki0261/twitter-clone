@extends('layouts.master')
@section('title','userAll')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table text-center">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">名前</th>
                    <th class="text-center">メールアドレス</th>
                    <th class="text-center">入会日</th>  
                </tr>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection