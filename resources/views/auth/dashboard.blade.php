@extends('layouts.app')

@section('content')
<div class="container">
    {{ $users->links() }}
    <h2>Admin Dashboard</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
            </tr>
        </thead>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role_id }}</td>
            </tr>
        @endforeach
    </table>
</div>
@endsection