<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;// ! BORRAR
use Illuminate\Http\Request;// ! BORRAR
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

//Rutas Para Usuarios Autenticados
Route::group(['middleware' => 'auth'], function () {

  //Rutas de Administración y configuración
  Route::prefix('admin/settings')->group(function(){

    Route::get('/home', function(){
      return view('Admin.home');
    });

    Route::get('/show-pack/{id}','PackController@showView');

    Route::get('/create-pack','PackController@create');

    Route::get('/edit-pack/{id}','PackController@edit');

    Route::get('/edit-clase/{clase_name}/etiqueta/{clase_id}','ClaseController@edit');

  });

  Route::get('/get-personal/token',function(){
    return [ 'data' => Auth::user()->api_token];
  });

});

// ! Borrar
Route::get('/domotica/get', function(){
  $data = ["data" => [
      0 => [
        "id" => 0,
        "name" => "abrir portón",
        "key_name" => ["afuera", "auto " , "Auto "],
      ],
      1 => [
        "id" => 1,
        "name" => "bajar portón",
        "key_name" => ["afuera", "auto " , "Auto "],
      ],
      2 => [
        "id" => 2,
        "name" => "prender luz",
        "key_name" => ["lámpara"],
      ],
    ]
  ];
  return $data;
});

Route::post('/domotica/send', function(Request $request){
  Log::channel('pack')->info($request);
});