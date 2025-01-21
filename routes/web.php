<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;

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
    return view('welcome');
});


// Registration Routes
Route::get('register', [AuthController::class, 'registerForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.store');

Route::get('login', [AuthController::class, 'loginForm'])->name('login');
Route::post('login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('feed', [PostController::class, 'index'])->name('feed');
    Route::resource('posts', PostController::class)->only(['show']);


    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');

    Route::post('/post/{postId}/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{commentId}', [CommentController::class, 'destroy'])->name('comment.destroy');
    Route::get('/comment/{commentId}/edit', [CommentController::class, 'edit'])->name('comment.edit');
    Route::put('/comment/{commentId}', [CommentController::class, 'update'])->name('comment.update');

    Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/post/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');
});