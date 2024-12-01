<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::group([
    'middleware' => ['auth', 'verified'],
], function() {
    Route::view('/', 'home')->name('home');

    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::group(['middleware' => ['role:admin|owner']], function () {
        Volt::route('cargos/create', 'pages.cargos.create');
    });

    Route::group(['middleware' => ['role:admin|driver']], function () {
        Volt::route('cargos/all', 'pages.cargos.all');
    });


    Volt::route('cargos-histories', 'pages.cargos.histories');
});
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
