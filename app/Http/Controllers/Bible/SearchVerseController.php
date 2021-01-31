<?php

namespace App\Http\Controllers\Bible;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchVerseController extends Controller
{
    //
    public function index(Request $request) {
        return view('bible.search-results', ['verses'=>[]]);
    }
}
