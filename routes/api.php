<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Comment\CommentController;
use App\Http\Controllers\Api\Post\PostController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Support\Facades\Route;

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
Route::post('login', [AuthController::class, 'login']);

Route::group(['prefix' => 'authors'], function () {
    Route::get('/', [UserController::class, 'index']);

    Route::post('/', [UserController::class, 'create']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    // GROUP api/posts
    Route::group(['prefix' => 'posts'], function () {
        // GET api/posts
        Route::get('/', [PostController::class, 'index']);
        // GET api/posts
        Route::post('/', [PostController::class, 'store']);
    });

    Route::group(['prefix' => 'comments'], function () {
        // POST api/comments
        Route::post('/', [CommentController::class, 'store']);
    });
});
