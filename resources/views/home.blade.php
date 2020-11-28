@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <p>Name: {{ $user->name }}</p>
                    <p>Email: {{ $user->email }}</p>
                    <a class="btn btn-primary" href="{{ route('bible') }}">
                        Read Bible
                    </a>
                        <?php
                            //  print_r($user);
                        ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
