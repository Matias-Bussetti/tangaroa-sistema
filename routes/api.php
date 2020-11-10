<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
//Route::apiResource('pack','PacksController')->middleware('auth:api');
//Route::apiResource('pack','PackController')->middleware('auth:api');


Route::group(['middleware' => 'api'], function () {

//List Articles
Route::get('pack','PackController@index');// Only one with the s

//List one Article
Route::get('pack/{id}','PackController@show');

//Create new Article
Route::post('pack','PackController@store');

//Update Article
Route::put('pack/{id}','PackController@update');

//Delete Article
Route::delete('pack/{id}','PackController@destroy');


//List Articles
//Route::get('semana','SemanaController@index');// Only one with the s

//List one Article
Route::get('semana/{id}','SemanaController@show');

//Create new Article
Route::post('semana','SemanaController@store');

//Update Article
Route::put('semana/{id}','SemanaController@update');

//Delete Article
Route::delete('semana/{id}','SemanaController@destroy');

});