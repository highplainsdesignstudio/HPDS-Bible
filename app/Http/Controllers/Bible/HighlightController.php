<?php

namespace App\Http\Controllers\Bible;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Highlight;
use Illuminate\Support\Facades\DB;

class HighlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $input = $request->all();
        $userId = $request->input('userId');
        $chapterId = $request->input('chapterId');
        // $highlights = Highlight::where('user_id', $userId)
        //     ->get();

        // return $highlights->toJson();
            $highlights = DB::table('highlights')
            ->select('verse_id', 'color', 'verses.chapter_id')
            ->join('verses', 'verse_id', '=', 'verses.id')
            ->where('user_id', '=', $userId)
            ->where('verses.chapter_id', '=', $chapterId)
            // ->where('highlights.deleted_at', '=', 'null')
            ->get();
 
        if ($highlights != null) {
            return $highlights->tojson();
        } else {
            return response()->json([
                'action' => 'completed'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $userId = $request->input('userId');
        $verseCount = $request->input('count');
        for ($i = 1; $i <= $verseCount; $i++) {
            $_name = 'verse_' . $i;
            $verseId = $request->input($_name);

            $existingHighlight = Highlight::withTrashed()
            ->where('user_id', $userId)
            ->where('verse_id', $verseId)
            ->first();

            if ($existingHighlight != null) {
                // if the highlight is soft deleted, restore it.
                if ($existingHighlight->trashed()) {
                    $existingHighlight->restore();
                } else {
                    //Remove highlight if highlight is already in the database.
                    $existingHighlight->delete();
                    // $action = "deleted";
                }

            } else {
                $highlight = new Highlight;
                $highlight->user_id =  (int)$userId;
                $highlight->verse_id = (int)$verseId;
                $highlight->color = 1;
                $highlight->save();
                // $action = "created";
            }
        }

        return response()->json([
                'action' => 'completed'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
