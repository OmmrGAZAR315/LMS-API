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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::get('/courses', 'CourseController@index');
Route::get('/courses/{course}', 'CourseController@show');
Route::post('/courses', 'CourseController@store');
Route::put('/courses/{course}', 'CourseController@update');
Route::delete('/courses/{course}', 'CourseController@destroy');
Route::delete('/courses/force/{course}', 'CourseController@forceDestroy');
Route::post('/courses/{course}/enroll', 'CourseController@enroll');
Route::post('/courses/{course}/unroll', 'CourseController@unroll');

Route::post('/courses/{course}/{user}/enroll', 'CourseController@enroll');
Route::post('/courses/{course}/{user}/unroll', 'CourseController@unroll');

Route::get('/users', 'UserController@index');
Route::get('/users/{user}', 'UserController@show');
Route::post('/users', 'UserController@store');
Route::put('/users/{user}', 'UserController@update');
Route::delete('/users/{user}', 'UserController@destroy');
Route::delete('/users/force/{user}', 'UserController@forceDestroy');


Route::post("/login", "AuthController@login");
Route::post("/register", "AuthController@register");
Route::post("/logout", "AuthController@logout");
Route::post("/refresh", "AuthController@refresh");
Route::post("/profile", "AuthController@me");


Route::get("/course/lessons", "LessonController@index");
Route::post("/course/material/{course}/{lesson}", "LessonController@upload");
Route::post("/course/lesson", "LessonController@store");

