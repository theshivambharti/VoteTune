<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Host\HostDashboardController;

Route::get('/dashboard', [HostDashboardController::class, 'index'])->name('dashboard');

// Room Management
Route::post('/room', [\App\Http\Controllers\RoomController::class, 'store'])->name('room.store');
Route::get('/room/{code}', [\App\Http\Controllers\RoomController::class, 'showHost'])->name('room.show');
Route::patch('/room/{room}/status', [\App\Http\Controllers\RoomController::class, 'updateStatus'])->name('room.status');

// Song Management
Route::post('/room/{room}/song', [\App\Http\Controllers\SongController::class, 'store'])->name('song.store');
Route::delete('/room/{room}/song/{song}', [\App\Http\Controllers\SongController::class, 'destroy'])->name('song.destroy');

// Placeholders for Host Navigation Audit
Route::get('/rooms', function() { return view('host.placeholder', ['title' => 'Rooms']); })->name('rooms');
Route::get('/songs', function() { return view('host.placeholder', ['title' => 'Songs']); })->name('songs');
Route::get('/queue', function() { return view('host.placeholder', ['title' => 'Queue']); })->name('queue');
Route::get('/voting', function() { return view('host.placeholder', ['title' => 'Voting']); })->name('voting');
Route::get('/analytics', function() { return view('host.placeholder', ['title' => 'Analytics']); })->name('analytics');
