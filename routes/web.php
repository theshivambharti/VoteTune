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
});

// Public Room Routes
Route::get('/r/{code}', [\App\Http\Controllers\RoomController::class, 'showPublic'])->name('room.show');
Route::post('/r/{room}/song/{song}/vote', [\App\Http\Controllers\VoteController::class, 'toggleVote'])->name('room.vote');

require __DIR__.'/auth.php';
require __DIR__.'/admin/settings.php';
