<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{GoogleController, RelasiController, SuratController, TargetController, TempelController, KirimController};

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', [TargetController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/sekretaris{id}', [ProfileController::class, 'sekretaris'])->name('profile.sekretaris');

});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::resource('relasi', RelasiController::class);
Route::resource('surat', SuratController::class);
Route::resource('tempel', TempelController::class);
Route::resource('kirim', KirimController::class);
Route::resource('edit', ProfileController::class);
require __DIR__.'/auth.php';
