<?php

namespace App\Services;

use App\Models\Room;
use App\Models\Song;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;
use App\Events\VoteCast;
use Exception;

class VoteService
{
    /**
     * Cast a vote for a song in a room.
     */
    public function castVote(Room $room, Song $song, string $voterIdentifier, ?int $userId = null, ?string $guestSessionId = null): Vote
    {
        if ($room->status !== 'active') {
            throw new Exception('Voting is closed for this room.');
        }

        if ($song->room_id !== $room->id) {
            throw new Exception('Song does not belong to this room.');
        }

        // Transaction safety to prevent race conditions during vote insertion
        return DB::transaction(function () use ($room, $song, $voterIdentifier, $userId, $guestSessionId) {
            // Check if vote already exists (double check despite DB unique constraint)
            $existingVote = Vote::where('room_id', $room->id)
                ->where('song_id', $song->id)
                ->where('voter_identifier', $voterIdentifier)
                ->lockForUpdate()
                ->first();

            if ($existingVote) {
                throw new Exception('You have already voted for this song.');
            }

            $vote = Vote::create([
                'room_id' => $room->id,
                'song_id' => $song->id,
                'voter_identifier' => $voterIdentifier,
                'user_id' => $userId,
                'guest_session_id' => $guestSessionId,
            ]);

            // Broadcast the vote cast event
            event(new VoteCast($room->id, $song->id));

            return $vote;
        });
    }

    /**
     * Uncast a vote.
     */
    public function removeVote(Room $room, Song $song, string $voterIdentifier): void
    {
        $vote = Vote::where('room_id', $room->id)
            ->where('song_id', $song->id)
            ->where('voter_identifier', $voterIdentifier)
            ->first();

        if ($vote) {
            $vote->delete();
            // Optionally, we could broadcast a VoteRemoved event if needed, but for now we'll just broadcast VoteCast with an updated count.
            event(new VoteCast($room->id, $song->id));
        }
    }
}
