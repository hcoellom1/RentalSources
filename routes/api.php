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


//get Route
Route::get('Localidad', 'LocalidadController@index');

Route::get('Solicitud/{id}', 'SolicitudController@show');

Route::get('AllTipoMaquinaria', 'TipoMaquinariaController@showallTipoMaquinaria');

Route::get('TipoMaquinaria/{idLocalidad}', 'TipoMaquinariaController@show');

Route::get('MachineConditions/{idMachine}', 'MachineConditionsController@show');

Route::get('Conditions', 'ConditionsController@show');

Route::get('users/loginUser', 'auth\LoginController@authenticate');



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