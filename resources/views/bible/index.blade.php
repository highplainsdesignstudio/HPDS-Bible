@extends('layouts.app')

@section('content')

    <?php
        $loggedIn = Auth::check();
        // var_dump($loggedIn);
        $apiToken = '';
        $userId = 0;

        if ($loggedIn) {
            if (session()->has('api-token')) {
                $apiToken = session('api-token');
            }
        $userId = auth()->user()->id;
        // dd($user);
        }
    ?>
    <div class="container">
        <div class="app">
            {{-- <router-link to="/read/example">Go to Example</router-link>

            <router-view></router-view> --}}
            <index-component :books="books" v-on:select-page="selectPage"></index-component>
            <page-component 
                :page="selectedPage" 
                :chapter-text="pageText"
                logged-in="{{ $loggedIn }}"
                v-on:leaf-page="leafPage"
                api-token="{{ $apiToken }}"
                :user-id="{{ $userId }}"></page-component>
        </div>
    </div>
@endsection