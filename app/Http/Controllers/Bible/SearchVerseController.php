<?php

namespace App\Http\Controllers\Bible;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Verse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchVerseController extends Controller
{
    //
    public function index(Request $request) {
        $query = $request->query();
        $verses = [];
        for($i = 1; $i <= intval($query['count']); $i++) {
            if(!isset($query["start{$i}"])) {
                $verses = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
                ->join('books', 'chapters.book_id', '=', 'books.id')
                ->where('books.book', 'LIKE', "%{$query['book'.$i]}%")
                ->where('chapters.book_chapter', '=', $query["chapter{$i}"])
                ->get();
                // ->paginate(25);
            } else {
                if(!isset($query["select{$i}"])) {
                    $verses = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
                    ->join('books', 'chapters.book_id', '=', 'books.id')
                    ->where('books.book', 'LIKE', "%{$query['book'.$i]}%")
                    ->where('chapters.book_chapter', '=', $query["chapter{$i}"])
                    ->where('chapter_verse', '=', $query["start{$i}"])
                    ->get();
                    // ->paginate(25);
                } else {
                    if($query["select{$i}"] == ',') {
                        $verse1 = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
                        ->join('books', 'chapters.book_id', '=', 'books.id')
                        ->where('books.book', 'LIKE', "%{$query['book'.$i]}%")
                        ->where('chapters.book_chapter', '=', $query["chapter{$i}"])
                        ->where('chapter_verse', '=', $query["start{$i}"]) 
                        // ->orWhere('chapter_verse', '=', $query['end1'])
                        ->get();
                        // ->paginate(25);
                        $verse2 = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
                        ->join('books', 'chapters.book_id', '=', 'books.id')
                        ->where('books.book', 'LIKE', "%{$query['book'.$i]}%")
                        ->where('chapters.book_chapter', '=', $query["chapter{$i}"])
                        // ->where('chapter_verse', '=', $query['start1']) 
                        ->where('chapter_verse', '=', $query["end{$i}"])
                        ->get();
                        // ->paginate(25);
                        $verses = $verse1->concat($verse2);
                    } elseif ($query['select1'] == '-') {
                        $verses = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
                        ->join('books', 'chapters.book_id', '=', 'books.id')
                        ->where('books.book', 'LIKE', "%{$query['book'.$i]}%")
                        ->where('chapters.book_chapter', '=', $query["chapter{$i}"])
                        ->whereBetween('chapter_verse', [$query["start{$i}"], $query["end{$i}"]])
                        ->get();
                        // ->paginate(25);
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
                                // ->paginate(25);
                            } else {
                                preg_match($andRegEx, $andVerse, $match);
                                $extraVerses = Verse::join('chapters', 'verses.chapter_id', '=', 'chapters.id')
                                ->join('books', 'chapters.book_id', '=', 'books.id')
                                ->where('books.book', 'LIKE', "%{$query['book'.$i]}%")
                                ->where('chapters.book_chapter', '=', $query["chapter{$i}"])
                                ->where('chapter_verse', '=', $match[0])
                                ->get();
                                // ->paginate(25);
                            }

                            $verses = $verses->concat($extraVerses);
                            // $verses = $verses->push($extraVerses);
                        }

                    }
                }
            }
            $results = new Collection();
            $results = ($i == 1) ? $verses : $results->concat($verses);
            // $results = ($i == 1) ? $verses : $results->push($verses);
            // $results = $results->concat($verses);
        }
        // }
        // This paginator may not really work. Take a look at how it was done in the HomeController for the saved highlights. 
        // You need to get the pgae number from the request and then use the forPage() method in order to change the $results.
        $verses = new LengthAwarePaginator($results->forPage(1, 25), count($results), 25, 1);
        $q = isset($query['string']) ? $query['string'] : null;
        return view('bible.search-results', ['verses'=>$verses, 'q'=>$q]);
    }
}
