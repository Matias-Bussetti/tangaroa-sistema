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

Route::apiResource('user','UserController');

//List Packs
Route::get('pack','PackController@index');// Only one with the s

//List one Pack
Route::get('pack/{id}','PackController@show');

//Create new Pack
Route::post('pack','PackController@store');

//Update Pack
Route::put('pack/{id}','PackController@update');

//Delete Pack
Route::delete('pack/{id}','PackController@destroy');


//List one Semana
Route::get('semana/{id}','SemanaController@show');

//Create new Semana
Route::post('semana','SemanaController@store');

//Update Semana
Route::put('semana/{id}','SemanaController@update');

//Delete Semana
Route::delete('semana/{id}','SemanaController@destroy');

//Progreso del usuario
Route::get('/progreso/{pack_id}/{user_id}','SemanaController@semanasClases');

//List one Clase
Route::get('clases/{id}','ClaseController@index');

//List one Clase
Route::get('clase/{id}','ClaseController@show');

//Create new Clase
Route::post('clase','ClaseController@store');

//Update Clase
Route::put('clase/{id}','ClaseController@update');

//Delete Clase
Route::delete('clase/{id}','ClaseController@destroy');

//List Entrenador
Route::get('entrenador','EntrenadorController@index');// Only one with the s

//List one Entrenador
Route::get('entrenador/{id}','EntrenadorController@show');

//Create new Entrenador
Route::post('entrenador','EntrenadorController@store');

//Update Entrenador
Route::put('entrenador/{id}','EntrenadorController@update');

//Delete Entrenador
Route::delete('entrenador/{id}','EntrenadorController@destroy');

//List one Clase
Route::get('clase/{clase_id}/user/{user_id}','ClaseController@claseDone');


//List all Presencial From specific Pack
Route::get('presenciales/{id}','PresencialController@showPack');

//Create new Presencial
Route::post('presencial','PresencialController@store');

//Return Link of specific Class
Route::get('presencial/link/{id}','PresencialController@giveLink');

//List one Presencial
Route::get('presencial/{id}','PresencialController@show');

//Update Presencial
Route::put('presencial/{id}','PresencialController@update');

//Delete Presencial
Route::delete('presencial/{id}','PresencialController@destroy');


});