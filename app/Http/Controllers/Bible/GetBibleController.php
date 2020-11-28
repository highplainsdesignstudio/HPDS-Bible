<?php

namespace App\Http\Controllers\Bible;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Cookie;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Verse;

class GetBibleController extends Controller
{
    //
    public function getBibleBooks() {
        return Book::all();
    }

    public function getBibleChapter($book_id, $chapter) {
        //TODO: This query needs to change to look up the chapter_id from the chapters table.

        $chapter_row = Chapter::where('book_id', $book_id)
                        ->where('book_chapter', $chapter)
                        ->get();

        $chapter_id = null;
        foreach($chapter_row as $chap) {
            $chapter_id = $chap->id;
        }

        $verses = Verse::where('book_id', $book_id)
            ->where('chapter_id', $chapter_id)
            ->get();

        return response($verses);
            // ->cookie('book_id', $book_id)
            // ->cookie('chapter_id', $chapter);
        // $cookie = Cookie::make('pizza', 'there is pizza');
        // return Verse::where('book_id', $book_id)
        //     ->where('chapter_id', $chapter_id)
        //     ->get()
        //     ->cookie($cookie);
    }

    public function getChapterId($chapter_id) {
        return Chapter::where('id', $chapter_id)
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
