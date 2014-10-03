@extends('layouts.master')

@section('content')
{{ Form::open(array('url' => 'user/create', 'class' => 'form-signup form-login')) }}
<h2>Register</h2>
<ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}
        @endforeach
    </ul>
    <div class="form-group">
        {{ Form::text('firstname', null, array('class' => 'form-control', 'placeholder' => 'First Name')) }}
    </div>
    <div class="form-group">
        {{ Form::text('lastname', null, array('class' => 'form-control', 'placeholder' => 'Last Name')) }}
    </div>
    <div class="form-group">
        {{ Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Username')) }}
    </div>
    <div class="form-group">
        {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
        </div>
        <div class="form-group">
        {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Confirm Password')) }}
    </div>
    <div class="form-group">
        {{ Form::submit('Register', array('class' => 'btn btn-lg btn-primary')) }}
        {{ Form::close() }}
        @stop