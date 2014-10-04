<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">PasswordShare</a>
            </div>
                <ul class="nav navbar-nav">
                    @if(Auth::check())
                        <li>{{ HTML::link('', 'Home') }}</li>
                        <li>{{ HTML::link('credentials', 'Credentials') }}</li>
                    @endif
                </ul> 
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())
                        @if(Auth::user()->isAdmin)
                            <li>{{ HTML::link('admin', 'Admin') }}</li>
                        @endif
                        <li>{{ HTML::link('logout', 'Logout') }}</li>
                    @else
                        <li>{{ HTML::link('login', 'Login') }}</li>
                        <li>{{ HTML::link('user/register', 'Register') }}</li>
                    @endif
                </ul>
        </div>
    </div>