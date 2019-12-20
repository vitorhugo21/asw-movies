<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/myCss.css') }}" rel="stylesheet">

    <title>ASW-MOVIES</title>
</head>

<body>
    <nav>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <ul class="navbar">
            <li><a href="">ASW-MOVIES</a></li>
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
    <div class="content mw-100 mh-100">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                @for ($index = 0; $index < count($movies); $index++) <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="@if($index == 0) active @endif">
                    </li>
                    @endfor
            </ol>
            <div class="carousel-inner">
                @foreach ($movies as $movie)
                <div class="carousel-item @if($loop->first) active @endif">
                    <img class="d-block w-100" src="https://image.tmdb.org/t/p/original{{$movie['backdrop_path']}}" alt="" srcset="">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{$movie['original_title']}}</h5>
                        <p>{{$movie['overview']}}</p>
                        <a href="{{ route('movie', $movie['id']) }}">See details</a>

                    </div>
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>