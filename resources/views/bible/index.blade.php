@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="app">
            {{-- <router-link to="/read/example">Go to Example</router-link> --}}

            {{-- <router-view></router-view> --}}
            <index-component></index-component>
        </div>
    </div>
@endsection