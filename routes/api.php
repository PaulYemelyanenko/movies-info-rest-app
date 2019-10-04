<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::get('movies', 'MovieController@movies');
Route::get('movies/{id}', 'MovieController@getMovie')->where('id', '[0-9]+');
Route::post('movies/search', 'MovieController@search');

Route::middleware('auth:api')->group(function () {
    Route::post('movies', 'MovieController@addMovie');
    Route::patch('movies/{id}', 'MovieController@editMovie')->where('id', '[0-9]+');
    Route::delete('movies/{id}', 'MovieController@deleteMovie')->where('id', '[0-9]+');
});



