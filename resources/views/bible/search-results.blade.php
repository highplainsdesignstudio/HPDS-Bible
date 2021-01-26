@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="app">
            <search-component></search-component>
            <index-component :books="books"></index-component>            
            <?php
                // dd($verses);
                // var_dump($verses);
            ?>
            @if (count($verses) > 0)
                <h2>{{ count($verses) }} search results.</h2>
                @foreach ($verses as $verse)
                    <p>{{ $verse->chapter->book->book }} {{ $verse->chapter->book_chapter }}:{{ $verse->chapter_verse }} - {{ $verse->verse }}</p>
                @endforeach

                @else
                    <h2>No results.</h2>
            @endif

        </div>
    </div>
@endsection