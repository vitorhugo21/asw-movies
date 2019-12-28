<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/myCss.css') }}" rel="stylesheet">
    @yield('more_styles')

    <title>@yield('title')</title>
</head>

<body>
    <nav>
        <ul class="navbar">
            <li><a href="{{route('index')}}">ASW-MOVIES</a></li>
            <form action="{{ route('discover') }}" method="get">
                <li><input type="text" name="discover" id=""></li>
                <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1" />
            </form>
            <div>
                <ul class="navbar menu2">
                    @guest
                    <li><a href="{{ route('register') }}">REGISTER</a></li>
                    <li><a href="{{ route('login') }}">LOGIN</a></li>
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if (auth()->user()->avatar_path)
                            <img src="{{ asset(auth()->user()->avatar_path) }}" style="width: 30px; height: 30px; border-radius: 50%;">
                            @endif
                            {{ Auth::user()->username }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-dark w-25" href="{{ route('user') }}">
                                {{ ('PROFILE') }}
                            </a>

                            <a class=" dropdown-item text-dark w-25" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
                                {{ ('LOGOUT') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </ul>
    </nav>
    <div>
        @yield('content')
    </div>

    <!-- Optional JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('more_scripts')

</body>

</html>