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
Route::get('/private', function (Request $request) {
    return response()->json(["message" => "Hello from a private endpoint! You need to have a valid access token to see this."]);
})->middleware('auth:api');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['middleware' => ['cors', 'auth.basic']], function () {
// 	Route::get('/dashboard', 'HeroController@dash');
// 	Route::get('/heroes', 'HeroController@index');
// 	Route::get('/hero/{id}', 'HeroController@show');
// });

// , 'auth:api'

Route::group(['middleware' => ['cors'], function () {
	Route::delete('/heroes/{id}', 'HeroController@destroy');
	Route::get('/heroes/search/{name}', 'HeroController@search');
	Route::get('/heroes/{id}', 'HeroController@show');
	Route::put('/heroes/{hero}', 'HeroController@update');
	Route::get('/heroes', 'HeroController@index');
	Route::post('/heroes', 'HeroController@store');
});

