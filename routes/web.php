<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Dashboard linked with redirect to login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Homepage, displays views/index.blade.php
Route::get('/', [Pagescontroller::class, 'index']);

// Route to resource controller, 
// only one route required.
//check php artisan route:list --name=posts --compact for all routes
Route::resource("posts", PostController::class);

// Route to CommentController
Route::resource('comments', CommentController::class);

