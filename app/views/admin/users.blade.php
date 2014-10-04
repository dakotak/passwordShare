@extends('admin.master')

@section('content')
@parent
<h1>User Managment</h1>
{{-- List users --}}
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Created On</th>
            <th>Updated On</th>
            <th>Is Admin</th>
        </tr>
    </thead>
    @foreach($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->firstName }}</td>
        <td>{{ $user->lastName }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->created_at }}</td>
        <td>{{ $user->updated_at }}</td>
        <td>{{ $user->isAdmin }}</td>
    </tr>
    @endforeach
</table>
@stop