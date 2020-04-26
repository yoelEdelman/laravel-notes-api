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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/notes', 'NoteController@index');
Route::get('/notes/{id}', 'NoteController@show');
Route::post('/notes', 'NoteController@store');
Route::put('/notes/{id}', 'NoteController@update');
Route::delete('/notes/{id}', 'NoteController@destroy');




