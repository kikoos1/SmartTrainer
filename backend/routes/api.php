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
Route::group(['middleware' => 'cors'], function(){
    Route::post('auth/register', 'AuthController@register');
    Route::post('auth/login', 'AuthController@login');
    Route::get('auth/user', 'AuthController@user');
});
Route::get('auth/register/code/{code}', 'AuthController@confirmCode');

Route::group(['middleware' => 'jwt.auth','cors'], function(){
    Route::get('auth/user', 'AuthController@user');
    Route::get('/daily-intake','MealController@get');
    Route::post('/food/add','FoodController@store');
    Route::get('/food/search/{search}','FoodController@search');
    Route::get('/food/{id}','FoodController@get');
    Route::post('/daily-intake/addMeal','MealController@store');
});

Route::group(['middleware' => 'jwt.refresh'], function(){
    Route::get('auth/refresh', 'AuthController@refresh');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
