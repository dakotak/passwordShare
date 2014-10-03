<!DOCTYPE html>
<html lang="en">
<head>
    <title>@section('title')Password Share@show</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/globalCustom.css') }}
</head>
<body>
    <!-- Navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">PasswordShare</a>
            </div>
                <ul class="nav navbar-nav">
                    @if(Auth::check())
                    <li><a href="{{{ URL::to('') }}}">Home</a></li>
                    <li><a href="{{{ URL::to('user', 'logout') }}}">Logout</a></li>
                    @else
                    <li>{{ HTML::link('user/register', 'Register') }}</li>
                    <li>{{ HTML::link('user/login', 'Login') }}</li>
                    @endif
                </ul> 
        </div>
    </div>

    <!-- Main Container -->
    <div class="container">
        <!-- Flash Message -->
        @if(Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        @yield('content')
    </div>

    <!-- Scripts -->
    {{ HTML::script('js/jquery-1.11.1.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
</body>
</html>