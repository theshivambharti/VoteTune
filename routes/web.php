<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/design-system', function () {
    return view('design-system');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dynamic dashboard based on role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin Dashboard explicit route (optional)
    Route::middleware(['role:Administrator'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

    // Host Dashboard explicit route (optional)
    Route::middleware(['role:Host'])->group(function () {
        Route::get('/host/dashboard', function () {
            return view('host.dashboard');
        })->name('host.dashboard');
    });
});

require __DIR__.'/auth.php';
require __DIR__.'/admin/settings.php';
