<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Highlight;
use Illuminate\Pagination\LengthAwarePaginator;

// use App\Models\Verse;
// use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $page = $request->query('page');
        $user = $request->user();
        $_highlights = $user->highlights;
        $_highlights = $_highlights->sortBy('verse_id');
        $_highlights = $_highlights->values();
        // $verses = new LengthAwarePaginator($results->forPage(1, 25), count($results), 25, 1);
        $current = $page == null ? $_highlights->forPage(1, 25) : $_highlights->forPage($page, 25);
        // $highlights = new LengthAwarePaginator($_highlights->forPage(1, 25), count($_highlights), 25);
        $highlights = new LengthAwarePaginator($current, count($_highlights), 25);
        $highlights->withPath('/home');
        return view('home', ['user'=>$user, 'highlights'=>$highlights]);
    }

    private function getUserHighlights($_userId) {
        $_highlights = Highlight::select('books.book', 'chapters.book_chapter', 'verses.chapter_verse', 'verses.verse')
            ->join('verses', 'verse_id', '=', 'verses.id')
            ->join('chapters', 'verses.chapter_id', '=', 'chapters.id')
            ->join('books', 'chapters.book_id', '=', 'books.id')
            ->where('user_id', $_userId)
            ->orderBy('verse_id', 'asc')
            ->get();
            return $_highlights;
    }

    // private function getUserHighlights ($user) {

    // }
}
