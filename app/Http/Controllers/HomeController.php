<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Highlight;
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
    public function index()
    {
        $user = Auth::user();
        $_highlights = $this->getUserHighlights($user->id);
        return view('home', ['user'=>$user, 'highlights'=>$_highlights]);

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
}
