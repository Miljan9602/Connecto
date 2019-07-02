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


Route::group(['prefix' => 'v1'], function ($router) {

    Route::apiResource('user', 'Api\UserController', ['middleware' => 'auth:api']);

    Route::group(['prefix' => 'profiles'], function ($router) {
        Route::get('current_user', 'Api\ProfileController@current_user')->name('profiles.current_user');
        Route::post('register', 'Api\ProfileController@register');
        Route::post('login', 'Api\ProfileController@login');
    });

});
