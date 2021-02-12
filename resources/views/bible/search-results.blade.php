@extends('layouts.app')

<?php
$results = collect();
$tokens = isset($tokens) ? collect($tokens) : 'negative';
foreach ($verses as $key => $verse) {
    $tmpCollect = collect([
        'book' => $verse->chapter->book->book,
        'book_chapter' => $verse->chapter->book_chapter, 
        'chapter_verse' => $verse->chapter_verse,
        'verse' => $verse->verse]);
    $results->push($tmpCollect);
}
?>

@section('content')
    <div class="container-fluid">
        {{-- <div class="app"> --}}
            <search-component q="{{$q}}"></search-component>
            <index-component :books="books"></index-component>            


            {{-- {{method_exists($verses, 'links')? $verses->links() : ""}} --}}
            @if(method_exists($verses, 'links')) 
                {{ $verses->links() }}
                <p>Showing {{$verses->firstItem()}} through {{$verses->lastItem()}} of {{$verses->total()}} results.</p>
            @else 
                <p>Showing {{count($verses)}} results.</p>
            @endif
            
            <search-results-component :tokens="{{ $tokens }}" :results="{{ $results }}"></search-results-component>

        {{-- </div> --}}
    </div>
@endsection