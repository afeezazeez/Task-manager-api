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

Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');


Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');

    // get all tasks
    Route::get('tasks', 'TaskController@index');

    // get single task
    Route::get('tasks/{id}', 'TaskController@show');

    // save task
    Route::post('tasks', 'TaskController@store');

    // update task
    Route::put('tasks/{id}', 'TaskController@update');

    // delete task
    Route::delete('tasks/{id}', 'TaskController@destroy');
});
