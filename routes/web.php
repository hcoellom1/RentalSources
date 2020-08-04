<?php

Route::get('user/verify/{verification_code}', "AuthController@verifyUser");

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

