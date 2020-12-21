@extends('layouts.app')

@section('content')

    <?php
        $loggedIn = Auth::check();
        $apiToken = '';
        $userId = 0;

        if ($loggedIn) {
            if (session()->has('api-token')) {
                $apiToken = session('api-token');
            }
        $userId = auth()->user()->id;
        }

    ?>
    <div class="container">
        <div class="app">

            <index-component 
            :books="books"
            v-on:select-page="selectPage"></index-component>

            <page-component
                book="{{ $book }}"
                chapter="{{ $chapter }}"
                :chapter-text="{{ $verses }}"
                :previous="{{ $previous }}"
                :next="{{ $next }}"></page-component>
                
        </div>
    </div>
@endsection