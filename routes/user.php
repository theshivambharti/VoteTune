<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserDashboardController;

// User specific routes
Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

// Placeholders for User Navigation Audit
Route::get('/rooms', function() { return view('user.placeholder', ['title' => 'My Rooms']); })->name('rooms');
Route::get('/history', function() { return view('user.placeholder', ['title' => 'Voting History']); })->name('history');
