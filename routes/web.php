<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;

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

Route::get('/', function () {
    return view('welcome');
});

// Dashboard linked with redirect to login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/home', function () {
    return view('home', $data);
});

Route::get('/posts', function () {
    $posts = DB::table('posts')->get();
    return view('posts.index', ['posts' => $posts] );
});



// Route to resource controller, 
// only one route required.
//check php artisan route:list --name=posts --compact for all routes
Route::resource("posts", PostController::class);

