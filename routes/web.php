<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
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

// Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
// Route::get('/roles', [PermissionController::class, 'Permission']);

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
	Route::redirect('/dashboard', 'posts/index')->name('dashboard');
	// Route::resource('posts', PostController::class);
	Route::get('posts/index', [PostController::class, 'index'])->name('posts');
	Route::get('posts/show/{post}', [PostController::class, 'show'])->name('posts.show');
	Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
	Route::post('posts/store', [PostController::class, 'store'])->name('posts.store');
	Route::get('posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
	Route::patch('posts/{post}/update', [PostController::class, 'update'])->name('posts.update');
	Route::delete('posts/destroy/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
	Route::delete('posts/delete-image/{post}', [PostController::class, 'deletePostImage'])->name('delete-post-image');
});
