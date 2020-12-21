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

    public function getBibleChapterText($book, $chapter) {
        $bookId = DB::table('books')
            ->where('book', $book)
            ->first();
        $chapterId = DB::table('chapters')
            ->where('book_id', $bookId->id)
            ->where('book_chapter', $chapter)
            ->first();
        
        $_previous = $chapterId->id == 1 ? 1189 : $chapterId->id - 1;
        $_next = $chapterId->id == 1189 ? 1 : $chapterId->id + 1;

        $previous = Chapter::where('id', $_previous)->first();
        $next = Chapter::where('id', $_next)->first();
        $previousBook = Book::where('id', $previous->book_id)->first();
        $nextBook = Book::where('id', $next->book_id)->first();

        $previousChapter['book'] = $previousBook->book;
        $previousChapter['chapter'] = $previous->book_chapter;
        $nextChapter['book'] = $nextBook->book;
        $nextChapter['chapter'] = $next->book_chapter;
        

        $verses = Verse::where('book_id', $bookId->id)
            ->where('chapter_id', $chapterId->id)
            ->get();

        return view('bible.index', ['verses' => $verses, 'book' => $book, 'chapter' => $chapter,
            'previous' => json_encode($previousChapter), 'next' => json_encode($nextChapter)]);
    }   

    public function getChapterById($chapter_id) {
        return Chapter::where('id', $chapter_id)
            ->get();
    }
}
