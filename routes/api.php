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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('showlist', 'ShowController@showlist');
Route::get('showlist/{id}', 'ShowController@showlistByID');
Route::post('showlist', 'ShowController@showlistSave');
Route::put('showlist/{id}', 'ShowController@showlistUpdate');
Route::delete('showlist/{show}', 'ShowController@showlistDelete');
