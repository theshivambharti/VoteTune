<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Song;
use App\Services\SongService;
use App\Http\Requests\StoreSongRequest;
use Illuminate\Http\Request;

class SongController extends Controller
{
    protected $songService;

    public function __construct(SongService $songService)
    {
        $this->songService = $songService;
    }

    /**
     * Add a song to a room.
     */
    public function store(StoreSongRequest $request, Room $room)
    {
        $this->authorize('manage', $room);

        try {
            $song = $this->songService->addSong($room, $request->validated('video_id'));
            
            // Re-load relationships if needed, or return raw. We usually just need to return success.
            return response()->json([
                'success' => true,
                'song' => $song,
                'message' => 'Song added successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }

    /**
     * Remove a song from a room.
     */
    public function destroy(Room $room, Song $song)
    {
        $this->authorize('manage', $room);
        
        if ($song->room_id !== $room->id) {
            return response()->json(['success' => false, 'message' => 'Song does not belong to this room.'], 403);
        }

        $this->songService->removeSong($song);

        return response()->json(['success' => true, 'message' => 'Song removed.']);
    }
}
