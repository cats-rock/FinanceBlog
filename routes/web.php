<?php

// Import the controllers so their short class names can be used in the routes below.
use App\Http\Controllers\ArticleController;
// Import WelcomeController so the route can use its short class name
// instead of the full App\Http\Controllers\WelcomeController namespace.
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\Userzone\ProfileController;
use App\Http\Controllers\WelcomeController;
// Import Laravel's Route facade, which is used to define the application's URLs.
use Illuminate\Support\Facades\Route;

// Public routes: visitors can access these pages without logging in.
// Homepage flow: GET request to / -> WelcomeController -> index() -> welcome view.
Route::get('/', [WelcomeController::class, 'index'])->name('home'); // When the get request is made to the root URL, the index method of the WelcomeController class is called.

// Articles flow: GET request to /articles -> ArticleController -> index() -> articles index view.
Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Authors are existing Users who have written at least one public Article.
Route::get('authors', [AuthorController::class, 'index'])->name('authors.index');
Route::get('authors/{user}', [AuthorController::class, 'show'])->name('authors.show');

// Tags can be browsed directly, and each Tag page lists its related public Articles.
Route::get('tags', [TagController::class, 'index'])->name('tags.index');
Route::get('tags/{tag}', [TagController::class, 'show'])->name('tags.show');

// Public routes: visitors can browse the tools list and view each tool's detail page.
Route::get('tools', [ToolController::class, 'index'])->name('tools.index');
Route::get('tools/{tool}', [ToolController::class, 'show'])->name('tools.show');

// Authenticated routes: only logged-in users can access these pages.
Route::get('/dashboard', function () {
    return view('userzone.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// The auth middleware redirects guests to login before any Article management action can run.
Route::middleware(['auth'])->group(function () {
    // GET the protected admin index containing every article.
    Route::get('admin/articles', [App\Http\Controllers\Admin\ArticleController::class, 'index'])
        ->name('admin.articles.index');

    // GET the protected form used to create an article.
    Route::get('admin/articles/create', [App\Http\Controllers\Admin\ArticleController::class, 'create'])
        ->name('admin.articles.create');

    // POST the completed form to store an article for the authenticated user.
    Route::post('admin/articles', [App\Http\Controllers\Admin\ArticleController::class, 'store'])
        ->name('admin.articles.store');

    // GET the protected form containing the selected article's current values.
    Route::get('admin/articles/{article}/edit', [App\Http\Controllers\Admin\ArticleController::class, 'edit'])
        ->name('admin.articles.edit');

    // PUT the submitted changes into the selected article.
    Route::put('admin/articles/{article}', [App\Http\Controllers\Admin\ArticleController::class, 'update'])
        ->name('admin.articles.update');

    // Display the Tools management list.
    Route::get('admin/tools', [App\Http\Controllers\Admin\ToolController::class, 'index'])
        ->name('admin.tools.index');

    // Display the form for creating a Tool.
    Route::get('admin/tools/create', [App\Http\Controllers\Admin\ToolController::class, 'create'])
        ->name('admin.tools.create');

    // Display the form containing the selected Tool's current values.
    Route::get('admin/tools/{tool}/edit', [App\Http\Controllers\Admin\ToolController::class, 'edit'])
        ->name('admin.tools.edit');

    // Save the submitted changes to the selected Tool.
    Route::put('admin/tools/{tool}', [App\Http\Controllers\Admin\ToolController::class, 'update'])
        ->name('admin.tools.update');

    // Delete the selected Tool through the administrator-only controller action.
    Route::delete('admin/tools/{tool}', [App\Http\Controllers\Admin\ToolController::class, 'destroy'])
        ->name('admin.tools.destroy');

    // DELETE the selected article by passing it to the controller's destroy method.
    Route::delete(
        'admin/articles/{article}',
        [App\Http\Controllers\Admin\ArticleController::class, 'destroy']
    )->name('admin.articles.destroy');

    // Protected CRUD routes for managing Tag records.
    Route::get('admin/tags', [App\Http\Controllers\Admin\TagController::class, 'index'])
        ->name('admin.tags.index');

    Route::get('admin/tags/create', [App\Http\Controllers\Admin\TagController::class, 'create'])
        ->name('admin.tags.create');

    Route::post('admin/tags', [App\Http\Controllers\Admin\TagController::class, 'store'])
        ->name('admin.tags.store');

    Route::get('admin/tags/{tag}/edit', [App\Http\Controllers\Admin\TagController::class, 'edit'])
        ->name('admin.tags.edit');

    Route::put('admin/tags/{tag}', [App\Http\Controllers\Admin\TagController::class, 'update'])
        ->name('admin.tags.update');

    Route::delete('admin/tags/{tag}', [App\Http\Controllers\Admin\TagController::class, 'destroy'])
        ->name('admin.tags.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
