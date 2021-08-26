@extends('layouts.app')

<?php 
    // dd($test);
    $apiToken = session('api-token');
?>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <p>Name: {{ $user->name }}</p>
                    <p>Email: {{ $user->email }}</p>
                    <a class="btn btn-primary" href="{{ route('bible') }}">
                        Read Bible
                    </a>
 
                    <div>
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">Saved Highlights</div>
                                    <div class="card-body">
                                        {{$highlights->links()}}
                                        {{-- <div v-for="(verse, index) in highlights" :key="index"> --}}
                                        @foreach ($highlights as $i => $t)
                                        <div class="row" id="highlight-{{ $i }}">
                                            <saved-highlights-component class="col-1" api-token="{{$apiToken}}" user="{{$user->id}}" id="{{$t->id}}" highlight="{{$i}}"></saved-highlights-component>
                                            <p class="col-11">
                                                <a href="/{{$t->verse->chapter->book->book}}/{{$t->verse->chapter->book_chapter}}#{{$t->verse->chapter_verse}}">
                                                {{$t->verse->chapter->book->book}} {{$t->verse->chapter->book_chapter}}:{{$t->verse->chapter_verse}}</a>
                                            - {!! $t->verse->verse !!}</p>
                                        </div>
                                            

                                        @endforeach
                                        {{-- <div>
                                            <p><a :href="`/${verse.book}/${verse.book_chapter}#${verse.chapter_verse}`">{{ verse.book }} Chapter {{ verse.book_chapter }} : {{ verse.chapter_verse }}</a>  - <span v-html="verse.verse"></span></p>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- <saved-highlights-component :highlights="{{ $highlights ?? '' }}"></saved-highlights-component> --}}
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
