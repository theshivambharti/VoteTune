<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Room;
use App\Models\Song;
use App\Models\Vote;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'hosts' => User::role('Host')->count(),
            'rooms' => Room::count(),
            'active_rooms' => Room::where('status', 'active')->count(),
            'songs' => Song::count(),
            'votes' => Vote::count(),
        ];

        $recentRooms = Room::with('user')->orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentRooms'));
    }
}
