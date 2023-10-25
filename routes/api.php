<?php

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

Route::post('/login',"AuthController@login")->name("login");

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/user',"AuthController@user")->name("user");
});

Route::middleware(['auth:sanctum','role:administrator'])->group(function () {
    Route::get("users/search",'UserController@search');
    Route::apiResource("users",'UserController')->only(['store','update','destroy']);
    Route::get("departments/search",'DepartmentController@search');
    Route::apiResource("departments",'DepartmentController')->only(['store','update','destroy']);
});

Route::middleware(['auth:sanctum','role:manager'])->group(function () {
    Route::post("users/my-employees",'UserController@myEmployees');
    Route::post("users/one-employees/{id}",'UserController@oneEmployees');
    Route::post("tasks",'TaskController@store');
});

Route::middleware(['auth:sanctum','role:employee'])->group(function () {
    Route::post("users/my-tasks",'UserController@myTasks');
    Route::apiResource("tasks",'TaskController')->only(['update']);
});

