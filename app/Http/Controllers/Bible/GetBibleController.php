<?php

namespace App\Http\Controllers\Bible;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Verse;

class GetBibleController extends Controller
{
    //
    public function getBibleBooks() {
        return Book::all();
    }

    public function getBibleChapter($book_id, $chapter) {
        return Verse::where('book_id', $book_id)
            ->where('chapter', $chapter)
            ->get();
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
