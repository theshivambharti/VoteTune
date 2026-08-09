<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Find rooms the user has voted in recently
        $recentVotes = Vote::where('user_id', $user->id)
                           ->with(['song', 'room'])
                           ->orderBy('created_at', 'desc')
                           ->take(10)
                           ->get();
                           
        $recentRoomIds = $recentVotes->pluck('room_id')->unique();
        
        $recentRooms = Room::whereIn('id', $recentRoomIds)
                           ->where('status', 'active')
                           ->get();
                           
        $stats = [
            'total_votes' => Vote::where('user_id', $user->id)->count(),
            'rooms_participated' => $recentRoomIds->count(),
        ];

        return view('user.dashboard', compact('recentVotes', 'recentRooms', 'stats'));
    }
}
