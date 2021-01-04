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
    <div class="container-fluid">
        <div class="app">

            <index-component 
            :books="books"></index-component>

            <page-component
                api-token="{{ $apiToken }}"
                book="{{ $book }}"
                chapter="{{ $chapter }}"
                :chapter-text="{{ $verses }}"
                :previous="{{ $previous }}"
                :next="{{ $next }}"
                user-id="{{ $userId }}"></page-component>

        </div>
    </div>
@endsection