<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Requests\BookRequest;


class BookController extends Controller {
    //ルーティング
    public function show($id) {
        $book_data = Book::findOrFail($id);
        return view('book', ['book' => $book_data]);
    }

    public function site() {
        $books = Book::all();
        return view('/book/index',compact('books'));
    }

    public function next($id) {
        $book = Book::findOrFail($id);
        return view('/book/edit',compact('book'));
    }
    
    public function new() {
        return view('/book/new');
    }

    public function update(BookRequest $request, $bookId) {
        $book = Book::find($bookId);
        
        $book->name = $request->input('name');
        $book->price = $request->input('price');
        $book->author = $request->input('author');

        $book->save();

        return view('/book/new',compact('book'));
    }

    public function delete ($id) {
        $book = Book::findOrFail($id);
        $book->delete();

        $books = Book::all();

        return view('/book/index',compact('books'));
        
    }

    //新規登録のビューを返す
    public function create() {
        return view('/book/form');
    }

    //新規登録のデータをデータベースに登録し、そのレコード全てを取得した後、ビューを返す
    public function store(BookRequest $request, Book $book){
        $book->store($request);//モデルの仕事が入っている（Book.php)
        $books = Book::all();

        return view('book/index',compact('books'));
    }
    
}
