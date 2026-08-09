<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

// Additional Admin routes for placeholders
Route::get('/users', function() { return view('admin.placeholder', ['title' => 'Users']); })->name('users');
Route::get('/hosts', function() { return view('admin.placeholder', ['title' => 'Hosts']); })->name('hosts');
Route::get('/rooms', function() { return view('admin.placeholder', ['title' => 'Rooms']); })->name('rooms');
Route::get('/songs', function() { return view('admin.placeholder', ['title' => 'Songs']); })->name('songs');
Route::get('/votes', function() { return view('admin.placeholder', ['title' => 'Votes']); })->name('votes');
Route::get('/plans', function() { return view('admin.placeholder', ['title' => 'Plans']); })->name('plans');
Route::get('/subscriptions', function() { return view('admin.placeholder', ['title' => 'Subscriptions']); })->name('subscriptions');
Route::get('/reports', function() { return view('admin.placeholder', ['title' => 'Reports']); })->name('reports');
Route::get('/activity', function() { return view('admin.placeholder', ['title' => 'Activity']); })->name('activity');
Route::get('/notifications', function() { return view('admin.placeholder', ['title' => 'Notifications']); })->name('notifications');
Route::get('/settings', function() { return view('admin.placeholder', ['title' => 'Settings']); })->name('settings');
