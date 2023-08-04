@extends('layouts.master')
@section('title','edit')

@section('content')
<div class="container ops-main">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3>Edit Profile</h3>
        </div> 
    </div>
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
        <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-1">
                <form action="{{ route('user.update', [ 'id' => Auth::id()]) }}" method="post">  
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="name">名前</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                    </div>
                    <button type="submit" class="btn btn-default">Save</button>
                    <a href="{{ route('top') }}">Cancel</a>
                </form>
            </div>
        </div>
</div>
@endsection