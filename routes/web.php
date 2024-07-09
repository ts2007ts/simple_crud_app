<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', [PostController::class, 'index2'])->name('default');

// die('ROUTE FILE PHP');

Route::get('/', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('default');

Route::resource('post', PostController::class)->middleware(['auth', 'verified']);



Route::middleware(['auth', 'verified'])->group(function () {

   Route::get('comment/create/{post}', [CommentController::class, 'create'])->name('comment.create');
   Route::post('comment/create/', [CommentController::class, 'store'])->name('comment.store');
   Route::get('comment/{comment}/edit/{post}', [CommentController::class, 'edit'])->name('comment.edit');
   Route::patch('comment/{comment}', [CommentController::class, 'update'])->name('comment.update');
   Route::delete('comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
});

Route::get('/dashboard', function () {
   return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
   Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
   Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
   Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
