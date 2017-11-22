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

//Route::get('buscar/{string}','paradaAPIController@getHorarios');
Route::get('/example',"twitterAPIController@principal");
Route::get('/example2',"twitterAPIController@twitter");



Route::resource('read_htmls', 'readHtmlAPIController');
Route::get('readHtmls', 'readHtmlAPIController@start');