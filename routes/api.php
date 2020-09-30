<?php

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

Route::prefix('v1')->namespace('Api\V1')->group(function () {

    Route::get('auth-google', 'GoogleAuthController@index');
    Route::post('auth-google/check', 'GoogleAuthController@checkGoogleAuth');
    Route::get('auth-google/url', 'GoogleAuthController@loginUrl');
    Route::get('auth-google/callback', 'GoogleAuthController@loginCallback');

    Route::middleware('auth:api')->group(function () {

        Route::prefix('user')->group(function ()
        {
            Route::get('/','UserController@profile');
            Route::get('/borrows','UserBorrowController@index'); //query string 'borrowstatus' optional
        });

        Route::prefix('borrows')->group(function () {
            Route::get('/', 'BorrowController@index');
            Route::get('/{id}', 'BorrowController@show');
            Route::post('/', 'BorrowController@store')->middleware('check_role:pm');
            Route::patch('/{id}/cancel', 'BorrowController@cancel')->middleware('check_role:chief');
            Route::patch('/{id}/accept', 'BorrowController@accept')->middleware('check_role:chief');
            Route::patch('/{id}/transfer', 'BorrowController@transfer')->middleware('check_role:admin');
            Route::patch('/{id}/returned', 'BorrowController@returnAll')->middleware('check_role:admin');
        });

        Route::prefix('categories')->group(function () {
            Route::get('/', 'CategoryController@index');
            Route::get('/{id}', 'CategoryController@show');
            Route::post('/', 'CategoryController@store')->middleware('check_role:admin');
            Route::put('/{id}', 'CategoryController@update')->middleware('check_role:admin');
            Route::delete('/{id}', 'CategoryController@destroy')->middleware('check_role:admin');
            Route::post('/{id}/upload-image', 'CategoryController@uploadImage')->middleware('check_role:admin');
        });

        Route::prefix('devices')->group(function () {
            Route::get('/', 'DeviceController@index');
            Route::get('/{id}', 'DeviceController@show');
            Route::post('/', 'DeviceController@store')->middleware('check_role:admin');
            Route::put('/{id}', 'DeviceController@update')->middleware('check_role:admin','possible_modified_device');
            Route::delete('/{id}', 'DeviceController@destroy')->middleware('check_role:admin','possible_modified_device');
            Route::post('/{id}/upload-image', 'DeviceController@uploadImage')->middleware('check_role:admin');
            Route::get('/{id}/related', 'DeviceController@getRelated');
        });

        Route::prefix('roles')->group(function () {
            Route::get('/', 'RoleController@index');
            Route::get('/{id}', 'RoleController@show');
            Route::post('/', 'RoleController@store')->middleware('check_role:admin');
            Route::patch('/{id}', 'RoleController@update')->middleware('check_role:admin');
        });

<<<<<<< HEAD


    // Route::apiResource('borrows', 'Api\V1\BorrowController');
    // Route::apiResource('roles', 'RoleController');
=======
        Route::prefix('admin/user')->group(function () {
            Route::get('/', 'UserController@index')->middleware('check_role:admin');
            Route::patch('/{id}', 'UserController@update')->middleware('check_role:admin');
            Route::delete('/{id}', 'UserController@destroy')->middleware('check_role:admin');
            Route::patch('/{id}/active', 'UserController@active')->middleware('check_role:admin');
            Route::patch('/{id}/generate-token', 'GoogleAuthController@generateTokenByUserId')->middleware('check_role:admin');
        });
>>>>>>> 95c855c25e25f96d8f745d4590d51380edb23387

    });

    Route::fallback(function () {
        return response()->json([
            'message' => 'Page Not Found. If error persists, contact info@neo-lab.com'
        ], 404);
    });

});
