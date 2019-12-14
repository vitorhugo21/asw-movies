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

Route::get('/', 'MovieController@index');
Route::get('/movie/{movie}', 'MovieController@showInfoMovie');
Route::get('/categories', 'MovieController@getAllCategories');
Route::get('/cast/{movie}', 'MovieController@getMovieCast');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
