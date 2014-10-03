@extends('layouts.master')

@section('content')
{{ Form::open(array('url' => 'user/login', 'class' => 'form-login')) }}
<h2>Please Login</h2>
<div class="form-group">
    {{ Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Username')) }}
</div>
<div class="form-group">
    {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
</div>
<div class="form-group">
    {{ Form::submit('Login', array('class' => 'btn btn-lg btn-primary')) }}
</div>
{{ Form::close() }}
@stop