<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'admin.redirect', 'ensure.subscription'])->name('dashboard');


Route::get('/pricing', function () {
    return view('pricing');
})->middleware(['auth', 'verified', 'admin.redirect'])->name('pricing');

Route::get('/checkout/{plan?}', CheckoutController::class)
    ->middleware(['auth', 'verified'])->name('checkout');

Route::get('/success', function () {
    return view('success');
})->middleware(['auth', 'verified'])->name('success');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/search', [UserController::class, 'search'])->name('admin.users.search');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::post('/users/{user}/deactivate', [UserController::class, 'deactivate'])->name('admin.users.deactivate');
    Route::post('/users/{user}/reactivate', [UserController::class, 'reactivate'])->name('admin.users.reactivate');
});

require __DIR__.'/auth.php';
