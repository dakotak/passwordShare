@extends('layouts.master')

@section('content')
<ul class="nav nav-tabs" role="tablist">
  <li>{{ HTML::link('admin', 'Admin Home') }}</li>
  <li>{{ HTML::link('admin/users', 'Users') }}</li>
  <li>{{ HTML::link('admin/groups', 'Groups') }}</li>
</ul>

@stop