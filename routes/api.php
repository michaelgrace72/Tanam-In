<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//region Plants
use App\Http\Controllers\PlantsController;

Route::get('/plants', [PlantsController::class, 'index']);
Route::post('/plants', [PlantsController::class, 'store']);
Route::get('/plants/{id}', [PlantsController::class, 'show']);
Route::put('/plants/{id}', [PlantsController::class, 'update']);
Route::delete('/plants/{id}', [PlantsController::class, 'destroy']);
//endregion

//region UserPlants
use App\Http\Controllers\UserPlantsController;

Route::get('/user-plants', [UserPlantsController::class, 'index']);
Route::post('/user-plants', [UserPlantsController::class, 'store']);
Route::get('/user-plants/{id}', [UserPlantsController::class, 'show']);
Route::put('/user-plants/{id}', [UserPlantsController::class, 'update']);
Route::delete('/user-plants/{id}', [UserPlantsController::class, 'destroy']);
//endregion

//region Posts
use App\Http\Controllers\PostsController;

Route::get('/posts', [PostsController::class, 'index']);
Route::post('/posts', [PostsController::class, 'store']);
Route::get('/posts/{id}', [PostsController::class, 'show']);
Route::put('/posts/{id}', [PostsController::class, 'update']);
Route::delete('/posts/{id}', [PostsController::class, 'destroy']);
//endregion

//region Reminders
use App\Http\Controllers\RemindersController;

Route::get('/reminders', [RemindersController::class, 'index']);
Route::post('/reminders', [RemindersController::class, 'store']);
Route::get('/reminders/{id}', [RemindersController::class, 'show']);
Route::put('/reminders/{id}', [RemindersController::class, 'update']);
Route::delete('/reminders/{id}', [RemindersController::class, 'destroy']);
//endregion

//region Guides
use App\Http\Controllers\GuidesController;

Route::get('/guides', [GuidesController::class, 'index']);
Route::post('/guides', [GuidesController::class, 'store']);
Route::get('/guides/{id}', [GuidesController::class, 'show']);
Route::put('/guides/{id}', [GuidesController::class, 'update']);
Route::delete('/guides/{id}', [GuidesController::class, 'destroy']);
//endregion