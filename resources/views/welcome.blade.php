@extends('layouts.app')

@section('content')

<div class="container-fluid">
    {{-- <div class="row"> --}}
        {{-- <img src="img/logo1.png" class="col-4 img-fluid"> --}}

    {{-- </div> --}}

    <div class="row">
        <section class="col-12 order-2 col-md-4 order-md-1">
            <img src="img/1.jpg" class="img-fluid">
            <img src="img/2.jpg" class="img-fluid mt-4">
            <img src="img/3.jpg" class="img-fluid mt-4">
            {{-- <img src="img/1.jpg" class="img-fluid">
            <img src="img/2.jpg" class="img-fluid">
            <img src="img/3.jpg" class="img-fluid"> --}}
        </section>

        <div class="col-12 order-1 col-md-8 order-md-2">
            <div class="jumbotron">
                <img src="/img/bible.jpg" alt="HPDS Life logo" class="img-fluid col-12">
                <a href="/read"><button class="btn btn-light col-6 col-md-4 offset-3 offset-md-4 mt-4">Read!</button></a>
            </div>

            <section>
                <h1 class="text-center">Welcome to HPDS Life</h1>
                <p>Welcome to the HPDS Bible. Here you will find the word of the Lord brought to you in the English, King James Version. Along with full
                    text of the Bible, you will find additional Bible study materials to better understand the most important historical document in existence.
                </p>
            </section>

        </div>



    </div>
</div>

@endsection