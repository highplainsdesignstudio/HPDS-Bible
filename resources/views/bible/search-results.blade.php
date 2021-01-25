@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="app">
            <search-component></search-component>

            <index-component :books="books"></index-component>
            
            Search Results
            <?php
                dd($verses);
                // var_dump($query);
            ?>

        </div>
    </div>
@endsection