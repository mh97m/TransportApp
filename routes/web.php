<?php

use App\Http\Controllers\CargosController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//////////////////////////////////////////////////

Route::get('/welcome', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//////////////////////////////////////////////////

Route::group([
    'middleware' => ['auth', 'verified'],
], function () {
    //////////////////////////////////////////////////

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

    //////////////////////////////////////////////////

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    //////////////////////////////////////////////////

    Route::controller(ProfileController::class)
        ->prefix('/profile')
        ->name('profile.')
        ->group(function () {
            Route::get('', 'edit')->name('edit');
            Route::patch('', 'update')->name('update');
            Route::delete('', 'destroy')->name('destroy');
        });

    //////////////////////////////////////////////////

    Route::controller(CargosController::class)
        ->prefix('/cargos')
        ->name('cargos.')
        ->group(function () {
            Route::middleware([
                'role:admin|driver',
            ])->group(function () {
                Route::get('list', 'list')->name('list');
            });

            Route::middleware([
                'role:admin|owner',
            ])->group(function () {
                Route::post('create', 'create')->name('create');
                Route::get('{cargo:ulid}', 'index')->name('index');
                Route::get('all', 'all')->name('all');
                Route::delete('{cargo:ulid}', 'index')->name('index');
            });

            Route::get('{cargo}/orders', 'orders')->name('orders');
            Route::get('histories', 'histories')->name('histories');
        });

    //////////////////////////////////////////////////

    Route::controller(OrdersController::class)
        ->middleware([
            'role:admin|owner|driver',
        ])
        ->prefix('/orders')
        ->name('orders.')
        ->group(function () {
            Route::post('create', 'create')->name('create');
            Route::get('{order:ulid}', 'index')->name('index');
            Route::get('all', 'all')->name('all');

            Route::get('{order:ulid}', 'set-status')->name('set-status');
        });

    //////////////////////////////////////////////////

});

//////////////////////////////////////////////////

require __DIR__.'/auth.php';
