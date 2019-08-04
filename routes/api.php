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

    Route::group(['prefix' => 'password'], function ($router) {
        Route::post('create', 'Api\PasswordResetController@create');
        Route::get('find/{token}', 'Api\PasswordResetController@find');
        Route::post('reset', 'Api\PasswordResetController@reset');
    });

    Route::apiResource('user', 'Api\UserController', ['middleware' => ['auth:api']]);

    Route::group(['prefix' => 'profiles'], function ($router) {
        Route::post('register', 'Api\ProfileController@register');
        Route::post('login', 'Api\ProfileController@login');

        Route::group(['middleware' => 'auth:api'], function ($router) {
            Route::get('current_user', 'Api\ProfileController@currentUser')->name('profiles.current_user');
        });
    });

    Route::group(['prefix' => 'friendships', 'middleware' => ['auth:api']], function ($router) {

        Route::post('/{user_id}', 'Api\FriendshipController@store')->name('friendships.create_new');
        Route::delete('/{user_id}', 'Api\FriendshipController@destroy')->name('friendships.destroy');

    });

});
