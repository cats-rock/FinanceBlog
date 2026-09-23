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

// CRUD for article
// These match the teacher's commits, but remain public while they are outside auth middleware.
// TODO: Protect all admin routes with the auth and verified middleware before production use.
// GET the admin index containing every article.
Route::get('admin/articles', [App\Http\Controllers\Admin\ArticleController::class, 'index'])->name('admin.articles.index');
// GET the empty form for creating an article.
Route::get('admin/articles/create', [App\Http\Controllers\Admin\ArticleController::class, 'create'])
    ->name('admin.articles.create');

// POST the completed form to store a new article.
Route::post('admin/articles', [App\Http\Controllers\Admin\ArticleController::class, 'store'])
    ->name('admin.articles.store');

// GET the form containing the selected article's current values.
Route::get('admin/articles/{article}/edit', [App\Http\Controllers\Admin\ArticleController::class, 'edit'])
    ->name('admin.articles.edit');

// PUT the submitted changes into the selected article.
Route::put('admin/articles/{article}', [App\Http\Controllers\Admin\ArticleController::class, 'update'])
    ->name('admin.articles.update');

// DELETE the selected article by passing it to the controller's destroy method.
Route::delete(
    'admin/articles/{article}',
    [App\Http\Controllers\Admin\ArticleController::class, 'destroy']
)->name('admin.articles.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
