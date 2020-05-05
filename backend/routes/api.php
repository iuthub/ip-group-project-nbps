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
    /**
     * Authentication routes
     */
    Route::post('login', 'AuthController@login')->name('api.login');
    Route::post('signup', 'AuthController@signup')->name('api.signup');
    /**
     * Category routes
     */
    Route::get('categories', 'CategoryController@all');
    Route::post('category/{category}/items', 'CategoryController@items');
    Route::get('category/{categoty}', 'CategoryController@show');

    /**
     * Table routes
     */
    Route::get('tables', 'TableController@all');
    /**
     * Item routes
     */
    Route::get('items', 'ItemController@all');
    Route::get('item/{item}/category', 'ItemController@category');
    Route::get('item/{item}', 'ItemController@show');

    /**
     * 
     * Routes with middleware auth
     */
    Route::middleware('auth:api')->group(function () {
        /**
         * Authentication routes
         */
        Route::post('refresh', 'AuthController@refresh')->name('api.refresh');
        Route::post('logout', 'AuthController@logout')->name('api.logout');
        /**
         * Account routes
         */
        Route::patch('account', 'AccountController@update')->name('api.account.update');
        Route::get('account', 'AccountController@show');
        /**
         * Order routes
         */
        Route::get('orders', 'OrderController@all');
        Route::get('order/{order}', 'OrderController@show')->where(['order' => '\d+']);
        Route::post('order', 'OrderController@store');
        /**
         * Table routes
         */
        Route::get('bookings/{table}', 'TableController@details')->where(['table' => '\d+']);
        /**
         * Booking routes
         */
        Route::post('table/{table}/book', 'BookingController@book');
        Route::get('bookings', 'BookingController@all');
    });
    /**
     * Public routes
     */
});
/**
 * Fallback function if the route has not been found
 */
Route::fallback(function (Request $request) {
    return response()->json([
        'message' => 'Not found'
    ], 404);
});
