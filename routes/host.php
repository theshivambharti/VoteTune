<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    $rooms = \App\Models\Room::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
    return view('host.dashboard', compact('rooms'));
})->name('dashboard');

// Room Management
Route::post('/room', [\App\Http\Controllers\RoomController::class, 'store'])->name('room.store');
Route::get('/room/{code}', [\App\Http\Controllers\RoomController::class, 'showHost'])->name('room.show');
Route::patch('/room/{room}/status', [\App\Http\Controllers\RoomController::class, 'updateStatus'])->name('room.status');

// Song Management
Route::post('/room/{room}/song', [\App\Http\Controllers\SongController::class, 'store'])->name('song.store');
Route::delete('/room/{room}/song/{song}', [\App\Http\Controllers\SongController::class, 'destroy'])->name('song.destroy');
