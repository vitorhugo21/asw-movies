<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
            <li><input type="text" name="" id=""></li>
            <div>
                <ul class="navbar menu2">
                    <li><a href="{{ route('register') }}">REGISTER</a></li>
                    <li><a href="{{ route('login') }}">LOGIN</a></li>
                </ul>
            </div>
        </ul>
    </nav>
    <div class="content mw-100 mh-100">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                @for ($index = 0; $index < count($movies); $index++) <li data-target="#carouselExampleIndicators"
                    data-slide-to="{{ $index }}" class="@if($index == 0) active @endif">
                    </li>
                    @endfor
            </ol>
            <div class="carousel-inner">
                @foreach ($movies as $movie)
                <div class="carousel-item @if($loop->first) active @endif">
                    <img class="d-block w-100" src="https://image.tmdb.org/t/p/original{{$movie['backdrop_path']}}"
                        alt="" srcset="">
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
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>