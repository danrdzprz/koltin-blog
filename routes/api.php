<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Post\PostController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'authors'], function () {
    Route::get('/', [UserController::class, 'index']);

    Route::post('/', [UserController::class, 'create']);
});


Route::middleware('auth:sanctum')->group(function () {
    // GROUP api/posts
    Route::group(['prefix' => 'posts'], function () {
        // GET api/posts
        Route::get('/', [PostController::class, 'index']);
        // GET api/posts
        Route::post('/', [PostController::class, 'store']);
    });
});
