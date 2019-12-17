<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//use Illuminate\Routing\Route;

Route::get('/', 'MovieController@index');

Route::get('/movie/{movie}', 'MovieController@showInfoMovie')->name('movie');
Route::post('/movie/{movie}/{state}', 'MovieController@changeState');

Route::get('/categories', 'MovieController@getAllCategories');

Route::get('/cast/{movie}', 'MovieController@getMovieCast');

<<<<<<< HEAD
Route::post('/movie/{movie}/{state}', 'MovieController@changeState');
=======
Route::get('/actor/{actor}', 'ActorController@getInfoActor')->name('actor');

Route::get('/discover', 'MovieController@discoverMovie')->name('discoverMovie');

>>>>>>> 6e4ed118fb1430cf6a7de32184c2a0a0ec8a8f9b

Route::get('/user/profile', 'UserMoviesController@index')->name('user');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
