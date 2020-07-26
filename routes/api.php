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
  

//get Route
//


Route::post('register','AuthController@register');

Route::get('Localidad', 'LocalidadController@index');

Route::get('Solicitud/{id}', 'SolicitudController@show');

Route::get('AllTipoMaquinaria', 'TipoMaquinariaController@showallTipoMaquinaria');

Route::get('TipoMaquinaria/{idLocalidad}', 'TipoMaquinariaController@show');

Route::get('MachineConditions/{idMachine}', 'MachineConditionsController@show');

Route::get('Conditions', 'ConditionsController@show');

Route::get('MyMaquinaria', "MaquinariaController@store");


//post Route
Route::post('Products', 'MaquinariaController@show');

Route::post('ProductsCart', 'MaquinariaController@getMaquinaria');

Route::post('SaveCart','SolicitudController@Store');

Route::post('image/SaveMaquinaria', 'MaquinariaController@store');




/*
Route::group(['middleware' => 'jwt.auth'], function ($router) {
    
    
    //Route::post('customers/new', 'CustomersController@new');
});
*/