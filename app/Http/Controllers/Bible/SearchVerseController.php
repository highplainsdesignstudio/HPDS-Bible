<?php

namespace App\Http\Controllers\Bible;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Verse;

class SearchVerseController extends Controller
{
    //
    public function index(Request $request) {
        $query = $request->query();
        $verses = [];
        if(!isset($query['count'])) {
            if(!isset($query['start1'])) {
                $verses = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
                ->join('books', 'chapters.book_id', '=', 'books.id')
                ->where('books.book', 'LIKE', "%{$query['book1']}%")
                ->where('chapters.book_chapter', '=', $query['chapter1'])
                ->get();
            } else {
                if(!isset($query['select'])) {
                    $verses = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
                    ->join('books', 'chapters.book_id', '=', 'books.id')
                    ->where('books.book', 'LIKE', "%{$query['book1']}%")
                    ->where('chapters.book_chapter', '=', $query['chapter1'])
                    ->where('chapter_verse', '=', $query['start1'])
                    ->get();
                } else {
                    if($select == ',');
                }

            }
        } else {
            for($i = 1; $i <= count($query['count']); $i++) {

            }
        }
        return view('bible.search-results', ['verses'=>$verses]);
    }
}
