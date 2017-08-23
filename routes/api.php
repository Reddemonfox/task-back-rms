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

Route::group(['middleware' => 'cors'], function () {
    Route::post('authenticate', ['uses' => 'AuthenticateController@authenticate', 'as' => 'authentication']);
    Route::get('authenticate/user', ['uses' => 'AuthenticateController@getAuthenticatedUser', 'as' => 'userAuthentication']);
    Route::get('users/{id}/tasks', 'TaskController@getTasks');
    Route::get('users/verify-buddy', 'UserController@verifyBuddy');
    Route::resource('users', 'UserController');
    Route::get('tasks/{taskId}/complete', 'TaskController@markComplete');
    Route::get('tasks/{taskId}/incomplete', 'TaskController@markInComplete');
    Route::post('tasks', 'TaskController@store');
});