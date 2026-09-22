<?php

// Import the controllers so their short class names can be used in the routes below.
use App\Http\Controllers\Userzone\ProfileController;
// Import WelcomeController so the route can use its short class name
// instead of the full App\Http\Controllers\WelcomeController namespace.
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ArticleController;

// Import Laravel's Route facade, which is used to define the application's URLs.
use Illuminate\Support\Facades\Route;

// Public routes: visitors can access these pages without logging in.
// Homepage flow: GET request to / -> WelcomeController -> index() -> welcome view.
Route::get('/', [WelcomeController::class, 'index'])->name('home'); // When the get request is made to the root URL, the index method of the WelcomeController class is called.

// Articles flow: GET request to /articles -> ArticleController -> index() -> articles index view.
Route::get('articles', [ArticleController::class, 'index']);
Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Authenticated routes: only logged-in users can access these pages.
Route::get('/dashboard', function () {
    return view('userzone.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
