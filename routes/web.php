<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::get('/home', function () {
    return view('home');
});

Route::middleware(['auth'])->group(function () {
    Route::resources([
        'posts' => PostController::class,
    ]);

    Route::get('/posts/user/{id}', [PostController::class, 'userPosts'])->name('posts.userPosts');
    Route::get('/posts/like/{id}', [PostController::class, 'like'])->name('posts.like');
    Route::get('/posts/dislike/{id}', [PostController::class, 'dislike'])->name('posts.dislike');
    Route::get('/user', [AuthController::class, 'userProfile'])->name('user.profile');
    Route::get('/user/edit', [AuthController::class, 'editProfile'])->name('user.edit');
    Route::put('/user/edit', [AuthController::class, 'updateProfile'])->name('user.update');
});

