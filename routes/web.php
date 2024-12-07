<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    $user = auth()->user();
    if ($user?->hasRole('driver')) {
        return to_route('cargos.all');
    }
    elseif ($user?->hasRole('owner')) {
        return to_route('cargos.create');
    }
    return view('home'); 
})->name('home');

Route::group([
    'middleware' => ['auth', 'verified'],
], function () {

    // Dashboard Route
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Admin & Owner Routes
    Route::group(['middleware' => ['role:admin|owner']], function () {
        // Create Cargo
        Volt::route('cargos/create', 'pages.cargos.create')->name('cargos.create');

        // View All Cargos by Owner
        Volt::route('cargos', 'pages.cargos.index')->name('cargos.index');

        // View Orders Accepted for Each Cargo
        Volt::route('cargos/{cargo}/orders', 'pages.cargos.orders')->name('cargos.orders');
    });

    // Admin & Driver Routes
    Route::group(['middleware' => ['role:admin|driver']], function () {
        // View All Available Cargos for Drivers
        Volt::route('cargos/all', 'pages.cargos.all')->name('cargos.all');

        // View Orders for Driver
        Volt::route('orders', 'pages.orders.index')->name('orders.index');

        // Accept Order
        Volt::route('orders/{order}/accept', 'pages.orders.accept')->name('orders.accept');
    });

    // Common Routes for Authenticated Users
    // Cargo History
    Volt::route('cargos-histories', 'pages.cargos.histories')->name('cargos.histories');

    // Ratings and Reviews
    Volt::route('ratings', 'pages.ratings.index')->name('ratings.index');
    Volt::route('ratings/{order}', 'pages.ratings.create')->name('ratings.create');
});





































/*
Route::view('/', 'home')->name('home');

Route::group([
    'middleware' => ['auth', 'verified'],
], function() {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::group(['middleware' => ['role:admin|owner']], function () {
        Volt::route('cargos/create', 'pages.cargos.create');
    });

    Route::group(['middleware' => ['role:admin|driver']], function () {
        Volt::route('cargos/all', 'pages.cargos.all')->name('cargos.all');
    });


    Volt::route('cargos-histories', 'pages.cargos.histories');
});
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
*/
require __DIR__.'/auth.php';
