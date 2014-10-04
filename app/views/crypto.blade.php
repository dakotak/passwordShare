@extends('layouts.master')

@section('content')
<h1>Crypto Key Length Test</h1>
    @foreach ($data as $test)
        <h2>{{ $test['size'] }} <small>{{ $test['time'] }}</small></h2>
        <h3>Public Key <small>{{ strlen(base64_decode($test['keys']['public'])) }}</small></h3>
        <pre>
            {{ $test['keys']['public'] }}
        </pre>
        <h3>Private Key <small>{{ strlen(base64_decode($test['keys']['private'])) }}</small></h3>
        <pre>
            {{ $test['keys']['private'] }}
        </pre>
        <hr>
    @endforeach
@stop