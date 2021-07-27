    <nav id="nav">
        <ul class="main-menu nav navbar-nav navbar-right">
            <li><a href="index.html"> {{ __('web.home') }} </a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                    aria-expanded="false">{{ __('web.cats') }} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    @foreach ($cats as $cat)

                        <li><a href="{{ url("categories/show/$cat->id") }}">{{ $cat->name() }}</a></li>

                    @endforeach

                </ul>
            </li>
            <li><a href="{{ url('/contact') }}"> {{ __('web.contact') }}</a></li>

            @guest
                <li><a href="{{ url('/login') }}"> {{ __('web.signin') }}</a></li>
                <li><a href="{{ url('/register') }}"> {{ __('web.signup') }}</a></li>
            @endguest
            @auth
                <form id="logoutForm" action="{{ url('/logout') }}" method="post" style="display: none">
                    @csrf
                </form>

                <li><a href="#" id="logoutLink"> {{ __('web.signout') }}</a></li>
                @if (Auth::user()->role->name == 'student')

                    <li><a href="{{ url('profile') }}"> {{ __('web.profile') }}</a></li>

                @else
                    <li><a href="{{ url('dashboard') }}"> {{ __('web.dashboard') }}</a></li>

                @endif
            @endauth


            @if (App::getlocale() == 'en')

                <li><a href="{{ url('lang/set/ar') }}"> ع </a></li>
            @else

                <li><a href="{{ url('lang/set/en') }}"> en</a></li>
            @endif
        </ul>
    </nav>
