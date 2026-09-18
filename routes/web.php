<?php

// Import the controllers so their short class names can be used in the routes below.
use App\Http\Controllers\Userzone\ProfileController;
use App\Http\Controllers\WelcomeController;

// Import Laravel's Route facade, which is used to define the application's URLs.
use Illuminate\Support\Facades\Route;

// Homepage flow: GET request to / -> WelcomeController -> index() -> welcome view.
Route::get('/', [WelcomeController::class, 'index'])->name('home'); // When the get request is made to the root URL, the index method of the WelcomeController class is called.

Route::get('/dashboard', function () {
    return view('userzone.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
