@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="app">
            {{-- <router-link to="/read/example">Go to Example</router-link> --}}

            {{-- <router-view></router-view> --}}
            <index-component :books="books" v-on:select-page="selectPage"></index-component>

            <?php
                $loggedIn = Auth::check() ? 'true' : 'false';
                
            ?>
            <page-component 
                :page="selectedPage" 
                :chapter-text="pageText"
                logged-in="{{ $loggedIn }}"
                v-on:leaf-page="leafPage"></page-component>
        </div>
    </div>
@endsection

{{-- Added for testing. --}}
<?php
 $user = auth()->user();
 var_dump($user);
?>