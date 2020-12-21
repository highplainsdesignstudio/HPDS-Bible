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
            {{-- <router-link to="/read/example">Go to Example</router-link>

            <router-view></router-view> --}}
            <index-component 
            :books="books"
            {{-- get-books-url="{{ $getBooksUrl }}" --}}
            {{-- public-url="{{ $publicUrl }}"  --}}
            v-on:select-page="selectPage"></index-component>
            {{-- <page-component 
                :page="selectedPage" 
                :chapter-text="pageText"
                logged-in="{{ $loggedIn }}"
                v-on:leaf-page="leafPage"
                api-token="{{ $apiToken }}"
                :user-id="{{ $userId }}"></page-component> --}}

            <page-component
                book="{{ $book }}"
                chapter="{{ $chapter }}"
                :chapter-text="{{ $verses }}"
                :previous="{{ $previous }}"
                :next="{{ $next }}"></page-component>

            {{-- <p>{{ $verses }}</p> --}}

        </div>
    </div>
@endsection