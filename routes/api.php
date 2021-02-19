<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
Route::post('forgot-password', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.reset');
Route::post('reset-password', 'Auth\ResetPasswordController@reset');
Route::post('register', 'Auth\RegisterController@register');

Route::group(['prefix' => 'v1'], function(){
    Route::group([
        'as' => 'api.',
        'namespace' => 'Api',
        // 'middleware' => 'auth:sanctum'
    ], function(){
        Route::apiResource('users', 'UserController');
        Route::apiResource('vehicles', 'VehicleController');
    });
});
