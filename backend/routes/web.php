<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::resource('items', 'ItemController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//Uncomment further

// Route::group([
//     'middleware' => [
//         'auth',
//         'role:administrator',
//     ],
// ], function () {
//     // Routes
// });
