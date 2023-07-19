<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $guarded = ['id']; 
    public function store($request) {
        //データベースの処理
        return Book::create([
            'name' => $request->name,
            'price' => $request->price,
            'author' => $request->author,
        ]);
    }
}
