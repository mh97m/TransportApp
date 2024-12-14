<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::group([
    'middleware' => ['auth', 'verified'],
], function () {
    Route::get('/', function () {
        $user = auth()->user();
        if ($user?->hasRole('driver')) {
            return to_route('cargos.list');
        }
        elseif ($user?->hasRole('owner')) {
            return to_route('cargos.create');
        }
        return view('home');
    })->name('home');
    

    // Dashboard Route
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Volt::route('cargos/list', 'pages.cargos.list')->name('cargos.list');


    // Admin & Owner Routes
    Route::group(['middleware' => ['role:admin|owner']], function () {
        Route::prefix('/cargos')->name('cargos.')->group(function () {
            Volt::route('all', 'pages.cargos.all')->name('all');
            Volt::route('create', 'pages.cargos.create')->name('create');
            Volt::route('{cargo:ulid}', 'pages.cargos.index')->name('index');

            // View Orders Accepted for Each Cargo
            Volt::route('{cargo}/orders', 'pages.cargos.orders')->name('orders');
        });
    });

    // Admin & Driver Routes
    Route::group(['middleware' => ['role:admin|driver']], function () {
        // View Orders for Driver
        Route::prefix('/orders')->name('orders.')->group(function () {
            Volt::route('all', 'pages.orders.all')->name('all');
            Volt::route('{order:ulid}', 'pages.orders.index')->name('index');
            Volt::route('{order:ulid}', 'pages.orders.set-status')->name('set-status');
        });

        // Accept Order
        Volt::route('orders/{order:ulid}/accept', 'pages.orders.accept')->name('orders.accept');
    });

    // Common Routes for Authenticated Users
    // Cargo History
    Volt::route('cargos-histories', 'pages.cargos.histories')->name('cargos.histories');

    // Ratings and Reviews
    Volt::route('ratings', 'pages.ratings.index')->name('ratings.index');
    Volt::route('ratings/{order}', 'pages.ratings.create')->name('ratings.create');

    Route::view('profile', 'profile')
        ->middleware(['auth'])
        ->name('profile');
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
