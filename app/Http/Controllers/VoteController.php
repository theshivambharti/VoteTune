<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Song;
use App\Services\VoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    protected $voteService;

    public function __construct(VoteService $voteService)
    {
        $this->voteService = $voteService;
    }

    /**
     * Cast or remove a vote.
     */
    public function toggleVote(Request $request, Room $room, Song $song)
    {
        if ($room->status !== 'active') {
            return response()->json(['success' => false, 'message' => 'Room is closed.'], 403);
        }

        $voterIdentifier = Auth::check() ? 'user_' . Auth::id() : $request->cookie('voter_id');
        
        if (!$voterIdentifier) {
            // Should have been set by showPublic, but just in case
            $voterIdentifier = 'guest_' . \Illuminate\Support\Str::uuid()->toString();
        }

        $userId = Auth::check() ? Auth::id() : null;
        $guestSessionId = Auth::check() ? null : $voterIdentifier;

        // Check if vote exists
        $hasVoted = \App\Models\Vote::where('room_id', $room->id)
            ->where('song_id', $song->id)
            ->where('voter_identifier', $voterIdentifier)
            ->exists();

        try {
            if ($hasVoted) {
                // Unvote
                $this->voteService->removeVote($room, $song, $voterIdentifier);
                $message = 'Vote removed.';
                $voted = false;
            } else {
                // Vote
                $this->voteService->castVote($room, $song, $voterIdentifier, $userId, $guestSessionId);
                $message = 'Vote cast.';
                $voted = true;
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'voted' => $voted,
            ])->cookie('voter_id', $voterIdentifier, 60 * 24 * 30);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }
}
