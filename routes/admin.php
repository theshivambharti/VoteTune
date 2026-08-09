<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\SongController;
use App\Http\Controllers\Admin\VoteController;

Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms');
Route::get('/songs', [SongController::class, 'index'])->name('songs');
Route::get('/votes', [VoteController::class, 'index'])->name('votes');
Route::get('/settings', [SettingController::class, 'index'])->name('settings');
