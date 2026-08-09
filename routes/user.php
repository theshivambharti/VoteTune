<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserDashboardController;

// User specific routes
Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
