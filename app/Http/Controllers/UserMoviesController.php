<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\TheMovieDBClass;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserMoviesController extends Controller
{

    private $movie_class;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->movie_class = new TheMovieDBClass();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $movieList['favorites'] = $this->getMovieList($user->movies()->where('favorite', 1)->get());
        $movieList['watchLater'] = $this->getMovieList($user->movies()->where('watch_later', 1)->get());
        $movieList['viewed'] = $this->getMovieList($user->movies()->where('viewed', 1)->get());
        //return $movieList;
        return view('user-profile', [
            'movies' => $movieList
        ]);
    }

    private function getMovieList($movieList)
    {
        if (count($movieList) !== 0) {
            $movieArray = [];
            foreach ($movieList as $movie) {
                array_push($movieArray, $this->movie_class->getMovie($movie['movie_id']));
            }
            return $movieArray;
        } else {
            return 0;
        }
    }

    public function updateProfile(Request $request)
    {

         // Get current user
         $user = User::findOrFail(Auth::user()->id);
      
        if ($request->has('userEmail') && !empty($request->input('userEmail') )) {
            $user->email = $request->input('userEmail');
        }

        if ($request->has('userPassword') && !empty($request->input('userPassword') )) {
            $user->password = Hash::make($request->input('userPassword'));
        }
       
  
        // Persist user record to database
        $user->save();

        // Return user back and show a flash message
        return redirect()->back()->with(['status' => 'Profile updated successfully.']);
    }
}
