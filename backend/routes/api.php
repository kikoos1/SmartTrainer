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
    //User
    Route::get('auth/user', 'AuthController@user');
    Route::patch('auth/user', 'AuthController@update');
    //Daily intake
    Route::get('/daily-intake/{date}','MealController@get');
    Route::get('/daily-intake/meal/{id}','MealController@getMeal');
    Route::post('/daily-intake/addMeal','MealController@store');
    Route::patch('/daily-intake/updateMeal','MealController@patch');
    Route::delete('/daily-intake/meal/{id}/delete/','MealController@delete');
    //Food
    Route::post('/food/add','FoodController@store');
    Route::get('/food/search/{search}','FoodController@search');
    Route::get('/food/{id}','FoodController@get');
    Route::get('/foods/get','FoodController@fetch');
    Route::patch('/food/{id}/update','FoodController@patch');
    Route::delete('/food/{id}/delete','FoodController@delete');
    //KG progress
    Route::post('/kg/add','KgController@store');
    Route::get('/kg/get','KgController@get');
    Route::patch('/kg/update','KgController@patch');
    Route::delete('/kg/{id}/delete','KgController@delete');
    //workouts
    Route::get('/workouts','WorkoutController@get');
    Route::post('/workouts/add','WorkoutController@store');
    Route::post('workout/exercises/add','WorkoutController@addexercise');
    Route::get('/workout/{id}','WorkoutController@getexercises');
    Route::delete('/workout/{id}/delete','WorkoutController@delete');
    //Exercise
    Route::get('/exercise/search/{search}','ExerciseController@find');
    Route::get('/exercise/{id}','ExerciseController@get');
    Route::post('exercise/add','ExerciseController@store');
    //Friends
    Route::get('/friends','FriendController@get');
    Route::get('/friends/search/{search}','FriendController@search');
    Route::get('/friends/requests','FriendController@requests');
    Route::post('/friends/requests/send','FriendController@store');
    Route::patch('/friends/requests/accept/','FriendController@patch');
    Route::delete('/friends/requests/decline/{id}','FriendController@delete');
});

Route::group(['middleware' => 'jwt.refresh'], function(){
    Route::get('auth/refresh', 'AuthController@refresh');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
