<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShortlinkController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Dashboard\Index;
use App\Livewire\Shortlink\Index as ShortlinkIndex;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Index::class)->name('dashboard');
    Route::get('/shortlink', ShortlinkIndex::class)->name('shortlink.index');
});

Route::get('/{alias}', [ShortLinkController::class, 'redirect'])->name('shortlink.redirect');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
