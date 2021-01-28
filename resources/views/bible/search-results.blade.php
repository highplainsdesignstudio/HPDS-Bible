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
            <section class="container">
                @if (count($verses) > 0)
                    <h2>{{ count($verses) }} search results.</h2>
                    @foreach ($verses as $verse)
                        <p>
                            <a href="/{{$verse->chapter->book->book}}/{{$verse->chapter->book_chapter}}#verse-{{$verse->chapter_verse}}">
                                {{ $verse->chapter->book->book }} {{ $verse->chapter->book_chapter }}:{{ $verse->chapter_verse }}
                            </a>
                        - {!! $verse->verse !!}</p>
                    @endforeach

                    @else
                        <h2>No results.</h2>
                @endif
            </section>


            {{-- <search-results-component  :results="{{ $verses->all()->toJson() }}"></search-results-component> --}}

        </div>
    </div>
@endsection