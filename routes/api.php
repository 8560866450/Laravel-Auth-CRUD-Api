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





Route::middleware(['auth:api'])->group(function () {

	
	Route::post('get-student','Api\StudentController@index');
	Route::post('create-student','Api\StudentController@create');
	Route::post('update-student','Api\StudentController@update');
	Route::post('delete-student','Api\StudentController@delete');
});
Route::post('login','Api\AuthController@login');
Route::post('register','Api\AuthController@register');
