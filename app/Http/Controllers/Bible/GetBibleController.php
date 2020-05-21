<?php

namespace App\Http\Controllers\Bible;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class GetBibleController extends Controller
{
    //
    public function getBibleBooks() {
        return Book::all();
    }

    // public function test() {
    //     $_books = [];
    //     $books = Book::all();
    //     foreach($books as $book) {
    //         array_push($_books, $book->book);
    //     }
    //     return Book::all();
    // }
}
