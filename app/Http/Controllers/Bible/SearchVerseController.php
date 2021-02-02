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
        // if(!isset($query['count'])) {
        //     if(!isset($query['start1'])) {
        //         $verses = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
        //         ->join('books', 'chapters.book_id', '=', 'books.id')
        //         ->where('books.book', 'LIKE', "%{$query['book1']}%")
        //         ->where('chapters.book_chapter', '=', $query['chapter1'])
        //         ->get();
        //     } else {
        //         if(!isset($query['select1'])) {
        //             $verses = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
        //             ->join('books', 'chapters.book_id', '=', 'books.id')
        //             ->where('books.book', 'LIKE', "%{$query['book1']}%")
        //             ->where('chapters.book_chapter', '=', $query['chapter1'])
        //             ->where('chapter_verse', '=', $query['start1'])
        //             ->get();
        //         } else {
        //             if($query['select1'] == ',') {
        //                 $verse1 = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
        //                 ->join('books', 'chapters.book_id', '=', 'books.id')
        //                 ->where('books.book', 'LIKE', "%{$query['book1']}%")
        //                 ->where('chapters.book_chapter', '=', $query['chapter1'])
        //                 ->where('chapter_verse', '=', $query['start1']) 
        //                 // ->orWhere('chapter_verse', '=', $query['end1'])
        //                 ->get();
        //                 $verse2 = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
        //                 ->join('books', 'chapters.book_id', '=', 'books.id')
        //                 ->where('books.book', 'LIKE', "%{$query['book1']}%")
        //                 ->where('chapters.book_chapter', '=', $query['chapter1'])
        //                 // ->where('chapter_verse', '=', $query['start1']) 
        //                 ->where('chapter_verse', '=', $query['end1'])
        //                 ->get();
        //                 $verses = $verse1->concat($verse2);
        //             } elseif ($query['select1'] == '-') {
        //                 $verses = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
        //                 ->join('books', 'chapters.book_id', '=', 'books.id')
        //                 ->where('books.book', 'LIKE', "%{$query['book1']}%")
        //                 ->where('chapters.book_chapter', '=', $query['chapter1'])
        //                 ->whereBetween('chapter_verse', [$query['start1'], $query['end1']])
        //                 ->get();
        //             }
        //         }
        //     }
        // } else {
            // $results = new Verse;
            for($i = 1; $i <= intval($query['count']); $i++) {
                if(!isset($query["start{$i}"])) {
                    $verses = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
                    ->join('books', 'chapters.book_id', '=', 'books.id')
                    ->where('books.book', 'LIKE', "%{$query['book'.$i]}%")
                    ->where('chapters.book_chapter', '=', $query["chapter{$i}"])
                    ->get();
                } else {
                    if(!isset($query["select{$i}"])) {
                        $verses = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
                        ->join('books', 'chapters.book_id', '=', 'books.id')
                        ->where('books.book', 'LIKE', "%{$query['book'.$i]}%")
                        ->where('chapters.book_chapter', '=', $query["chapter{$i}"])
                        ->where('chapter_verse', '=', $query["start{$i}"])
                        ->get();
                    } else {
                        if($query["select{$i}"] == ',') {
                            $verse1 = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
                            ->join('books', 'chapters.book_id', '=', 'books.id')
                            ->where('books.book', 'LIKE', "%{$query['book'.$i]}%")
                            ->where('chapters.book_chapter', '=', $query["chapter{$i}"])
                            ->where('chapter_verse', '=', $query["start{$i}"]) 
                            // ->orWhere('chapter_verse', '=', $query['end1'])
                            ->get();
                            $verse2 = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
                            ->join('books', 'chapters.book_id', '=', 'books.id')
                            ->where('books.book', 'LIKE', "%{$query['book'.$i]}%")
                            ->where('chapters.book_chapter', '=', $query["chapter{$i}"])
                            // ->where('chapter_verse', '=', $query['start1']) 
                            ->where('chapter_verse', '=', $query["end{$i}"])
                            ->get();
                            $verses = $verse1->concat($verse2);
                        } elseif ($query['select1'] == '-') {
                            $verses = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
                            ->join('books', 'chapters.book_id', '=', 'books.id')
                            ->where('books.book', 'LIKE', "%{$query['book'.$i]}%")
                            ->where('chapters.book_chapter', '=', $query["chapter{$i}"])
                            ->whereBetween('chapter_verse', [$query["start{$i}"], $query["end{$i}"]])
                            ->get();
                        }

                        // Now, check if there is &and= data. If so, process the verses.
                        if (isset($query["and{$i}"])) {
                            $andRegEx = "/\d+/";
                            $thruRegEx = "/\d+-\d+/";
                            $andVerses = explode(',', $query["and{$i}"]);
                            foreach($andVerses as $andVerse) {
                                if (preg_match($thruRegEx, $andVerse)) {
                                    preg_match_all($andRegEx, $andVerse, $matches);
                                    $extraVerses = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
                                    ->join('books', 'chapters.book_id', '=', 'books.id')
                                    ->where('books.book', 'LIKE', "%{$query['book'.$i]}%")
                                    ->where('chapters.book_chapter', '=', $query["chapter{$i}"])
                                    ->whereBetween('chapter_verse', [intval($matches[0][0]), intval($matches[0][1])])
                                    ->get();
                                } else {
                                    preg_match($andRegEx, $andVerse, $match);
                                    $extraVerses = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
                                    ->join('books', 'chapters.book_id', '=', 'books.id')
                                    ->where('books.book', 'LIKE', "%{$query['book'.$i]}%")
                                    ->where('chapters.book_chapter', '=', $query["chapter{$i}"])
                                    ->where('chapter_verse', '=', $match[0])
                                    ->get();
                                }

                                $verses = $verses->concat($extraVerses);
                            }

                        }
                    }
                }
                $results = ($i == 1) ? $verses : $results->concat($verses);
                // $results = $results->concat($verses);
            }
        // }
        return view('bible.search-results', ['verses'=>$results]);
    }
}
