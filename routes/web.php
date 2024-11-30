<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::group([
    'middleware' => ['auth', 'verified'],
], function() {
    Route::view('/', 'home')->name('home');
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Volt::route('cargos/create', 'pages.cargos.create');
    Volt::route('cargos/all', 'pages.cargos.all');
});
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
