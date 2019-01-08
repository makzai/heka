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

Route::get('health', function () {
    return "health";
});

Route::get('keywords', 'OtherController@keywords');
Route::get('wishes', 'OtherController@wishes');
Route::get('views', 'ViewController@index');
Route::get('view/{id}', 'ViewController@show');
Route::get('categories', 'CategoryController@index');
Route::get('information', 'InformationController@index');

Route::post('set', 'OtherController@set');
Route::get('get', 'OtherController@get');