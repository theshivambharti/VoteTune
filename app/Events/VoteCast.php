<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Song;

class VoteCast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $roomId;
    public $songId;
    public $voteCount;
    
    /**
     * Dispatch the event only after the database transaction commits.
     */
    public $afterCommit = true;

    /**
     * Create a new event instance.
     */
    public function __construct(int $roomId, int $songId)
    {
        $this->roomId = $roomId;
        $this->songId = $songId;
        
        // Harden vote count: explicitly scope by both room and song
        $this->voteCount = \App\Models\Vote::where('room_id', $roomId)
            ->where('song_id', $songId)
            ->count();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('room.' . $this->roomId),
        ];
    }
}
