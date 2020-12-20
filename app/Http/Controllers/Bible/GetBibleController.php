<?php

namespace App\Http\Controllers\Bible;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Cookie;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Verse;
use Illuminate\Support\Facades\DB;

class GetBibleController extends Controller
{
    //
    public function getBibleBooks() {
        return Book::all();
    }

    // public function getBibleChapterText($book_id, $chapter) {
    //     //TODO: This query needs to change to look up the chapter_id from the chapters table.
    //     $chapter_row = Chapter::where('book_id', $book_id)
    //                     ->where('book_chapter', $chapter)
    //                     ->get();

    //     $chapter_id = null;
    //     foreach($chapter_row as $chap) {
    //         $chapter_id = $chap->id;
    //     }

    //     $verses = Verse::where('book_id', $book_id)
    //         ->where('chapter_id', $chapter_id)
    //         ->get();

    //     return response($verses);
    // }

    public function getBibleChapterText($book, $chapter) {
        $bookId = DB::table('books')
            ->where('book', $book)
            ->first();
        $chapterId = DB::table('chapters')
            ->where('book_id', $bookId->id)
            ->where('book_chapter', $chapter)
            ->first();

        // $verses = Verse::join('chapters', 'chapter_id', '=', 'chapters.id')
        // ->where('chapters.book_id', $bookId->id)
        // ->where('chapters.book_chapter', $chapter)
        // ->get();

        $verses = Verse::where('book_id', $bookId->id)
            ->where('chapter_id', $chapterId->id)
            ->get();

        return view('bible.index', ['verses' => $verses, 'book' => $book, 'chapter' => $chapter]);
    }   

    public function getChapterById($chapter_id) {
        return Chapter::where('id', $chapter_id)
            ->get();
    }
}
