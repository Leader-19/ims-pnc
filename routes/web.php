<?php

use App\Http\Controllers\CompanyInternshipController;
use App\Http\Controllers\CompanyInterviewsController;
use App\Http\Controllers\ContactSupervisorController;
use App\Http\Controllers\FinalReportController;
use App\Http\Controllers\FinalSlideController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeeklyWorklogController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

/**
 * Dashboard route
 */
Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * User routes
 * create, retrieve, update, delete
 */
Route::resource('users', UserController::class)
    ->only(['create', 'store'])
    ->middleware('permission:users.create');

Route::resource('users', UserController::class)
    ->only(['edit', 'update'])
    ->middleware('permission:users.edit');

Route::resource('users', UserController::class)
    ->only(['destroy'])
    ->middleware('permission:users.delete');

Route::resource('users', UserController::class)
    ->only(['index', 'show'])
    ->middleware('permission:users.create|users.edit|users.delete|users.view');

/**
 * Role routes
 */
Route::resource('roles', RoleController::class)
    ->only(['create', 'store'])
    ->middleware('permission:roles.create');

Route::resource('roles', RoleController::class)
    ->only(['edit', 'update'])
    ->middleware('permission:roles.edit');

Route::resource('roles', RoleController::class)
    ->only(['destroy'])
    ->middleware('permission:roles.delete');

Route::resource('roles', RoleController::class)
    ->only(['index', 'show'])
    ->middleware('permission:roles.create|roles.edit|roles.delete|roles.view');


/**
 * Internship route
 */

Route::resource('internships', CompanyInternshipController::class);

/**
 * Interview route
 */

Route::resource('company-interviews', CompanyInterviewsController::class);

/**
 * Final slide route
 */

Route::resource('final-slides', FinalSlideController::class);

/**
 * Final report route
 */

Route::resource('final-reports', FinalReportController::class);

/**
 * Contact Supervisor
 */

Route::resource('contact-supervisors', ContactSupervisorController::class);

/**
 * weekly worklog route
 */

Route::resource('weekly-worklogs', WeeklyWorklogController::class);

require __DIR__ . '/settings.php';
