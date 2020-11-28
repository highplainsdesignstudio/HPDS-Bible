@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="app">
            {{-- <router-link to="/read/example">Go to Example</router-link> --}}

            {{-- <router-view></router-view> --}}
            <index-component :books="books" v-on:select-page="selectPage"></index-component>
            <page-component 
                :page="selectedPage" 
                :chapter-text="pageText"   
                v-on:leaf-page="leafPage"></page-component>
        </div>
    </div>
@endsection