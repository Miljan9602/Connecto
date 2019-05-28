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

    Route::group(['prefix' => 'user'], function ($router) {

        Route::post('login', 'Api\UserController@login');
        Route::post('register', 'Api\UserController@register');
        Route::get('details', 'Api\UserController@register');

    });

});
