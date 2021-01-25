<?php

namespace App\Http\Controllers\Bible;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Verse;
use Illuminate\Support\Str;

class SearchBibleController extends Controller
{
    //
    public function index(Request $request) {
        
        $query = $request->query();
        // $querys = Str::of($query['q'])->explode(' ');
        $verses = Verse::where('verse', 'LIKE', "%{$query['q']}%")
        ->get();
        return view('bible.search-results', ['verses' => $verses]);
    }
}
