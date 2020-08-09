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


Route::prefix('auth')->group(function () {
 
    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');
    Route::get('refresh','AuthController@refresh');
 
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
 
});

  

Route::get('Localidad', 'LocalidadController@index');

Route::get('Solicitud/{id}', 'SolicitudController@show');

Route::get('AllTipoMaquinaria', 'TipoMaquinariaController@showallTipoMaquinaria');

Route::get('TipoMaquinaria/{idLocalidad}', 'TipoMaquinariaController@show');

Route::get('MachineConditions/{idMachine}', 'MachineConditionsController@show');

Route::get('Conditions', 'ConditionsController@show');

Route::get('MyMaquinaria/{mailOwner}', "MaquinariaController@showMyMaquinaria");

Route::get('MachineNames', "MaquinariaController@getMachinesByName");


//post Route
Route::post('Products', 'MaquinariaController@show');

Route::post('ProductsCart', 'MaquinariaController@getMaquinaria');

Route::post('SaveCart','SolicitudController@Store');

Route::post('image/SaveMaquinaria', 'MaquinariaController@store');