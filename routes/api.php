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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['middleware' => ['cors', 'auth.basic']], function () {
// 	Route::get('/dashboard', 'HeroController@dash');
// 	Route::get('/heroes', 'HeroController@index');
// 	Route::get('/hero/{id}', 'HeroController@show');
// });

Route::group(['middleware' => 'cors'], function () {
	Route::get('/dashboard', 'HeroController@dash');
	Route::get('/heroes/{id}', 'HeroController@show');
	Route::get('/heroes', 'HeroController@index');
});

