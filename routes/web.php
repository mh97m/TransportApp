<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::group([
    'middleware' => ['auth', 'verified'],
], function() {
    Route::view('/', 'home');
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Volt::route('cargo/create', 'pages.cargo.create');
});
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
