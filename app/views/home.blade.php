@extends('layouts.master')

@section('content')
    <div class="row">
        {{--div class="col-md-10 col-md-offset-2"> --}}
            <form class="form-inline" action="{{ URL::to('search') }}" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" />
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Search</button>
                    </span>
                </div>
            </form>
        {{--</div>--}}
    </div>
@stop