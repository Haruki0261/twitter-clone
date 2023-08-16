@extends('layouts.master')
@section('title', 'tweet.details')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card mt-5">
                    <div class="card-header p-3 w-100 d-flex ">
                        <div class="ml-2 d-flex flex-column">
                            <p class="mb-0">{{ $tweet->user->name }}</p>
                        </div>
                        <div class="d-flex justify-content-end flex-grow-1">
                            <p class="mb-0">{{ $tweet->updated_at }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ $tweet->content }}
                    </div>
                    <div class="d-flex justify-content-end mx-3 my-1">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            編集
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header d-block text-center">
                                        <h5 class="modal-title" id="staticBackdropLabel">投稿編集</h5>
                                    </div>
                                    <div class="modal-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger" id="error-message">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    <form action="{{ route('tweet.update', ['id' => $tweet->id]) }}" method="post">
                                            @method('put')
                                            @csrf
                                            <input type="text" class="form-control input-lg" name="content"
                                                value="{{ $tweet->content }}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        @if ($tweet->author_id == Auth::id())
                                            <button type="submit" class="btn btn-primary">編集</button>
                                        @else
                                            <button type="button" class="btn btn-primary" disabled>編集</button>
                                        @endif
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#delete">
                            削除
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="delete" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header d-block text-center">
                                        <h5 class="modal-title" id="staticBackdropLabel">削除確認</h5>
                                    </div>
                                    <div class="modal-body text-center">
                                        本当に削除してもいいですか？
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        @if ($tweet->author_id == Auth::id())
                                        <a href="{{ route('tweet.delete', ['id' => $tweet->id]) }}" class='btn btn-danger'>削除</a>
                                        @else
                                            <button type="button" class="btn btn-danger" disabled>削除</button>
                                        @endif
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
