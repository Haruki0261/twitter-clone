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
        </tr>
        <tr>
          <td>
            {{ $user->id }}
          </td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->created_at }}</td>
          <td>
          <a href="{{ route('user.showEdit') }}" class='btn btn-light'>編集</a>
          <a href="{{ route('user.delete') }}" class='btn btn-warning'>削除</a>
          </td>
        </tr>
      </table>
    </div>
</div>
@endsection
