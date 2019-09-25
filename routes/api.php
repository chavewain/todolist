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

/**
*   Users
*/
Route::resource('users', 'User\UserController', ['except' => ['create', 'edit']]);
Route::name('verify')->get('users/verify/{token}', 'User\UserController@verify');
Route::name('resend')->get('users/{user}/resend', 'User\UserController@resend');


/**
*   Categories
*/
Route::resource('categories', 'Category\CategoryController', ['except' => ['create', 'edit']]);
Route::resource('categories.tasks', 'Category\CategoryTaskController', ['only' => ['index']]);


/**
*   Tasks
*/
Route::resource('tasks', 'Task\TaskController', ['only' => ['index', 'show']]);
Route::resource('tasks.categories', 'Task\TaskCategoryController', ['only' => ['index', 'update', 'destroy']]);
