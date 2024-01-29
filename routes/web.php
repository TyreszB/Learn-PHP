<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExampleConttroller;

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

Route::get('/', [UserController::class, "showCorrectHomepage"])->name('/login');

Route::post('/register', [UserController::class, "register"])->middleware('guest');
Route::post('/login', [UserController::class, "login"])->middleware('guess');
Route::post('/logout', [UserController::class, "logout"])->('auth');

Route::get('/create-post', [PostController::class, "showCreatePost"])->middleware('auth');
Route::get('/post/{post}', [PostController::class, "viewSinglePost"])->middleware('auth');
Route::post('/create-post', [PostController::class, "createPost"])->middleware('auth');