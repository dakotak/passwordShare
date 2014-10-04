@extends('layouts.master')
@section('content')
<h1>Add Password</h1>
<form action="{{ URL::to('credentials/add') }}" method="post">
    <fieldset>
        <legend>Add Credential</legend>
        <div class="control-group">
          <label class="control-label" for="title">Title</label>
          <div class="controls">
            <input id="title" name="title" type="text" placeholder="Title" class="input-xlarge" required="">
        </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="type">Credential Type</label>
      <div class="controls">
        <select id="type" name="type" class="input-xlarge">
        </select>
    </div>
</div>
<div class="control-group">
  <label class="control-label" for="username">Username</label>
  <div class="controls">
    <input id="username" name="username" type="text" placeholder="Username" class="input-xlarge" required="">
</div>
</div>
<div class="control-group">
  <label class="control-label" for="password">Password</label>
  <div class="controls">
    <input id="password" name="password" type="password" placeholder="password" class="input-xlarge" required="">
</div>
</div>
<div class="control-group">
  <label class="control-label" for="notes">Notes</label>
  <div class="controls">                     
    <textarea id="notes" name="notes"></textarea>
</div>
</div>
<div class="control-group">
  <label class="control-label" for=""></label>
  <div class="controls">
    <button id="" name="" class="btn btn-default">Button</button>
</div>
</div>
</fieldset>
</form>
@stop