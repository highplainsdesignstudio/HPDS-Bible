@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        {{-- <img src="img/logo1.png" class="col-4 img-fluid"> --}}

    </div>

    <div class="row">
        <section class="col-4">
            <img src="img/1.jpg" class="img-fluid">
            <img src="img/2.jpg" class="img-fluid">
            <img src="img/3.jpg" class="img-fluid">
            <img src="img/1.jpg" class="img-fluid">
            <img src="img/2.jpg" class="img-fluid">
            <img src="img/3.jpg" class="img-fluid">
        </section>

        <div class="col-8">
            <div class="jumbotron">
                <img src="img/bible.jpg" alt="HPDS Life logo" class="img-fluid col-12">
                <button class="btn btn-light col-2 offset-5 mt-4"><a href="/read">Read!</a></button>
            </div>

            <section>
                <blockquote>
                    <p>And the earth was without form, and void; and darkness was upon the face of the deep. And the Spirit of God moved upon the face of the waters.</p>
                </blockquote>
                <blockquote>
                    <p>And God said, Let there be lights in the firmament of the heaven to divide the day from the night; and let them be for signs, and for seasons, and for days, and years:</p>
                </blockquote>
                <blockquote>
                    <p>Then the presidents and princes sought to find occasion against Daniel concerning the kingdom; but they could find none occasion nor fault; forasmuch as he was faithful, neither was there any error or fault found in him.</p>
                </blockquote>
            </section>

        </div>



    </div>
</div>

@endsection