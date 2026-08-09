<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Song;
use App\Services\VoteService;
use App\Http\Requests\StoreVoteRequest;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    protected $voteService;

    public function __construct(VoteService $voteService)
    {
        $this->voteService = $voteService;
    }

    /**
     * Cast a vote.
     */
    public function store(StoreVoteRequest $request, Room $room, Song $song)
    {
        if ($room->status !== 'active') {
            return response()->json(['success' => false, 'message' => 'Room is closed.'], 403);
        }

        $voterIdentifier = Auth::check() ? 'user_' . Auth::id() : $request->cookie('voter_id');
        
        if (!$voterIdentifier) {
            $voterIdentifier = 'guest_' . \Illuminate\Support\Str::uuid()->toString();
        }

        $userId = Auth::check() ? Auth::id() : null;
        $guestSessionId = Auth::check() ? null : $voterIdentifier;

        try {
            $this->voteService->castVote($room, $song, $voterIdentifier, $userId, $guestSessionId);
            return response()->json([
                'success' => true,
                'message' => 'Vote cast.',
                'voted' => true,
            ])->cookie('voter_id', $voterIdentifier, 60 * 24 * 30);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }

    /**
     * Remove a vote.
     */
    public function destroy(Request $request, Room $room, Song $song)
    {
        if ($room->status !== 'active') {
            return response()->json(['success' => false, 'message' => 'Room is closed.'], 403);
        }

        $voterIdentifier = Auth::check() ? 'user_' . Auth::id() : $request->cookie('voter_id');

        if (!$voterIdentifier) {
            return response()->json(['success' => false, 'message' => 'No vote found.'], 404);
        }

        try {
            $this->voteService->removeVote($room, $song, $voterIdentifier);
            return response()->json([
                'success' => true,
                'message' => 'Vote removed.',
                'voted' => false,
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }
}
