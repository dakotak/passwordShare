@extends('admin.master')

@section('content')
@parent
<h1>Group Management</h1>
<div class="well">
    <p>Groups are used as an intermediary between the encrypted passwords and the users, this way
        we only need to store and ancrypted version of the password for each group that has access to it vs each user who has access to it. Users will be able to access and encrypted version of the groups private key.</p>
</div>

<h2>Current Groups</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created By</th>
        </tr>
    </thead>
    <tbody>
        {{-- Generate Groups --}}
        @foreach($groups as $group)
            <tr>
                <td>{{ $group->id }}</td>
                <td>{{ $group->name }}</td>
                <td>{{ $group->creator->username }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<form class="form-inline" action="{{ URL::to('admin/groups') }}" method="post">
    <input type="text" class="form-control" name="groupname" placeholder="Group Name" />
    <button type="submit" class="btn btn-defult">Add Group</button>

</form>
@stop