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

Route::get('/getUsers', 'App\Http\Controllers\UserController@getUsers');
Route::post('/createUser', 'App\Http\Controllers\UserController@createUser');
Route::delete('/removeUser', 'App\Http\Controllers\UserController@removeUser');
Route::put('/updateUser', 'App\Http\Controllers\UserController@updateUser');
