<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::group([
    'middleware' => [
        'auth',
        'admin'
    ]
], function () {
    Route::get('', function (Request $request) {
        return redirect()->route('home');
    });

    Route::get('home', 'HomeController@index')->name('home');
    Route::resource('item', 'ItemController')->except(['show']);
    Route::resource('table', 'TableController')->except(['show']);
    Route::resource('category', 'CategoryController')->except(['show']);

    Route::get('/changeStatusCategory/{id}', [
            'uses' => 'CategoryController@changeStatusCategory',
            'as' => 'changeStatusCategory',
            'middleware' => ['auth']
    ]);


    Route::get('/changeStatusItem/{id}', [
            'uses' => 'ItemController@changeStatusItem',
            'as' => 'changeStatusItem',
            'middleware' => ['auth']
    ]);
    Route::resource('booking', 'BookingController');
    Route::resource('order', 'OrderController')->except(['create', 'store', 'edit', 'update']);
    Route::resource('orderItem', 'OrderItemController')->except(['index', 'show', 'create', 'store', 'edit', 'update']);
});
