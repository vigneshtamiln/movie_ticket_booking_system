<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   

    Route::get('/', fn () => redirect('/shows'));
    Route::get('/shows', [ShowController::class, 'index'])->name('shows.index');
    Route::get('/shows/{id}/book', [ShowController::class, 'book'])->name('shows.book');

    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

});

require __DIR__.'/auth.php';
