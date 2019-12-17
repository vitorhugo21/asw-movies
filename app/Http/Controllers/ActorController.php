<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\TheMovieDBClass;

class ActorController extends Controller
{
    private $movie_class;

    public function __construct()
    {
        $this->movie_class = new TheMovieDBClass();
    }

    public function getInfoActor($actor)
    {
        $infoActor = $this->movie_class->getInfoActor($actor);
        if (array_key_exists('status_code', $infoActor)) {
            abort(404, 'ACTOR NOT FOUND');
        }

        return $infoActor;
    }
}
