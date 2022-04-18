<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


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

Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');

Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::post('/posts/{post}/store', [CommentController::class, 'store'])->name('comments.create');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show')->middleware('auth');

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');

Route::get('/comments/{post}/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit')->middleware('auth');

Route::delete('/posts/{post}', [PostController::class, 'delete'])->name('posts.delete');

Route::delete('/comments/{post}/{comment}', [CommentController::class, 'delete'])->name('comments.delete');

Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

Route::put('/comments/{post}/{comment}', [CommentController::class, 'update'])->name('comment.update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

Route::get('/auth/callback/{provider}', [SocialiteController::class, 'callback']);
