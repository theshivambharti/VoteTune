<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Song;
use App\Models\Vote;

class HostDashboardController extends Controller
{
    public function index()
    {
        $rooms = Room::where('user_id', auth()->id())
                     ->orderBy('created_at', 'desc')
                     ->get();
                     
        $roomIds = $rooms->pluck('id');
        
        $stats = [
            'total_rooms' => $rooms->count(),
            'active_rooms' => $rooms->where('status', 'active')->count(),
            'total_songs' => Song::whereIn('room_id', $roomIds)->count(),
            'total_votes' => Vote::whereIn('room_id', $roomIds)->count(),
        ];

        return view('host.dashboard', compact('rooms', 'stats'));
    }
}
