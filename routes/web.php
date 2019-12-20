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

Route::get('/', 'MovieController@index')->name('index');;

Route::get('/movie/{movie}', 'MovieController@showInfoMovie')->name('movie');
Route::post('/movie/{movie}/{state}', 'MovieController@changeState');

Route::get('/categories', 'MovieController@getAllCategories');

Route::get('/cast/{movie}', 'MovieController@getMovieCast');

Route::get('/actor/{actor}', 'ActorController@getInfoActor')->name('actor');

Route::get('/discover', 'MovieController@discover')->name('discover');


Route::get('/user/profile', 'UserMoviesController@index')->name('user');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
