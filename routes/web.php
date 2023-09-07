<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ApplicationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(SessionController::class)->as('sessions.')->group(function() {
    Route::get('/login', 'create')->name('create');

    Route::post('/login', 'store')->name('store');
});

Route::controller(HomeController::class)->group(function() {
    Route::get('/', 'index')->name('home');
});

Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');

Route::middleware('auth')->group(function() {
    Route::delete('/logout', [SessionController::class, 'destroy'])->name('sessions.destroy');

    Route::controller(ApplicationController::class)->as('applications.')->prefix('applications')->group(function() {
        Route::get('/', 'index')->name('index');

        Route::get('/pending', 'pending')->name('pending');

        Route::put('/{application}/coordinator-action', 'coordinatorAction')->name('coordinator-action');

        Route::put('/{application}/manager-action', 'managerAction')->name('manager-action');
    });
});

