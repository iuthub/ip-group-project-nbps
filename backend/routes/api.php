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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'namespace' => 'Api',
], function () {
    Route::post('login', 'AuthController@login')->name('api.login');
    Route::post('logout', 'AuthController@logout')->name('api.logout');
    Route::post('signup', 'AuthController@signup')->name('api.signup');
    Route::post('refresh', 'AuthController@refresh')->name('api.refresh');
    Route::middleware('auth:api')->group(function () {
        Route::patch('account', 'AccountController@update')->name('api.account.update');
        Route::get('account', 'AccountController@show');
    });
});
/**
 * Fallback function if the route has not been found
 */
Route::fallback(function (Request $request) {
    return response()->json([
        'message' => 'Not found'
    ], 404);
});
