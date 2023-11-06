<?php

use App\Http\Controllers\Web\AuthorController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->name('web.dashboard');

Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('web.authors.show');

Route::get('posts/{post}', [PostController::class, 'show'])->name('web.posts.show');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
