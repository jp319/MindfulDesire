<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

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

Route::view('/', 'welcome')->name('welcome');
Route::get('/blog', [PostController::class, 'index'])->name('blog');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('blog.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{category:name}', [CategoryController::class, 'show'])->name('categories.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/posts', [ProfileController::class, 'index'])->name('profile.posts');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
