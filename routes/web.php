<?php

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

Route::get('/', function () {
    return '<h1>home Page</h1><a href= "/about-us" >view about page</a>';
});
Route::get('/about-us', function () {
    return '<h1>About PAge</h1><a href= "/" >Back to home</a>';
});
