<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Services\RoomService;
use App\Http\Requests\StoreRoomRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    protected $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    /**
     * Store a newly created room in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        $room = $this->roomService->createRoom(Auth::id(), $request->validated('name'));

        return redirect()->route('host.room.show', $room->room_code)
            ->with('success', 'Room created successfully!');
    }

    /**
     * Display the specified room for the host.
     */
    public function showHost(string $code)
    {
        $room = Room::where('room_code', strtoupper($code))->firstOrFail();
        
        $this->authorize('manage', $room);

        // Load songs with vote counts
        $room->load(['songs' => function ($query) {
            $query->withCount('votes')->orderByDesc('votes_count');
        }]);

        return view('host.room', compact('room'));
    }

    /**
     * Display the specified room for users/guests.
     */
    public function showPublic(string $code, Request $request)
    {
        $room = $this->roomService->findActiveRoomByCode($code);

        if (!$room) {
            return redirect()->route('dashboard')->with('error', 'Room not found or closed.');
        }

        $room->load(['songs' => function ($query) {
            $query->withCount('votes')->orderByDesc('votes_count');
        }]);

        // Generate a persistent guest identifier if not logged in
        $voterIdentifier = Auth::check() ? 'user_' . Auth::id() : $request->cookie('voter_id');
        
        if (!Auth::check() && !$voterIdentifier) {
            $voterIdentifier = 'guest_' . \Illuminate\Support\Str::uuid()->toString();
            // We need to attach this cookie to the response, which we can do using cookie() helper.
            return response()->view('room.show', compact('room', 'voterIdentifier'))
                ->cookie('voter_id', $voterIdentifier, 60 * 24 * 30); // 30 days
        }

        return view('room.show', compact('room', 'voterIdentifier'));
    }

    /**
     * Update room status.
     */
    public function updateStatus(Request $request, Room $room)
    {
        $this->authorize('manage', $room);
        
        $status = $request->input('status');
        if (in_array($status, ['active', 'closed'])) {
            $this->roomService->updateStatus($room, $status);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
}
