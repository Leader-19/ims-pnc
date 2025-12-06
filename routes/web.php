<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');


/**
 * dashboard router
 */

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * user router
 * @create, retrive, updaet and delete
 */

Route::resource("users", UserController::class);

/**
 * Role router
 */

Route::resource("roles", RoleController::class);

require __DIR__.'/settings.php';
