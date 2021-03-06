<?php
/**
 * Try to use methods from BaseController (App\Http\Controllers\BaseController)
 *
 * GET getAll -> route-name ?+ params (for 'where')
 * GET getOne -> route-name/{id} ?+ params (for 'where')
 * POST createOne -> route-name + data
 * PUT updateOne -> route-name/{id} + data
 * DELETE deleteOne -> route-name/{id}
 */

Route::group(['middleware' => 'language'], function () {

    Route::post('login', 'User\\AuthController@login');
    Route::post('register', 'User\\AuthController@register');
    Route::post('refresh-token', 'User\\AuthController@refreshToken');

    Route::group(['middleware' => 'jwt-auth:user'], function () {
        Route::get('user', 'User\\UserController@getOne');
        Route::put('user/{id}', 'User\\UserController@updateOne');

        Route::get('user-params', 'UserOption\\CalorieCalculatorController@getOne');
        Route::put('user-params/{id}', 'UserOption\\CalorieCalculatorController@updateOne');

        Route::post('logout', 'User\\AuthController@logout');
    });

    Route::group(['prefix' => 'organization'], function () {
        Route::post('login', 'Organization\\AuthController@login');
        Route::post('register', 'Organization\\AuthController@register');

        Route::group(['middleware' => 'jwt-auth:organization'], function () {
            //
        });

    });

    Route::get('countries', 'Location\\CountryController@getAll');
    Route::get('regions', 'Location\\RegionController@getAll');
    Route::get('cities', 'Location\\CityController@getAll');

    Route::get('sexes', 'UserOption\\SexController@getAll');
    Route::get('lifestyles', 'UserOption\\LifestyleController@getAll');
    Route::get('goals', 'UserOption\\GoalController@getAll');

});
