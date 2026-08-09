<?php

namespace App\Services;

use App\Models\Room;
use Illuminate\Support\Str;

class RoomService
{
    /**
     * Create a new room for a host.
     */
    public function createRoom(int $hostId, string $name): Room
    {
        return Room::create([
            'user_id' => $hostId,
            'name' => $name,
            'room_code' => $this->generateUniqueRoomCode(),
            'status' => 'active',
        ]);
    }

    /**
     * Generate a unique 6-character uppercase alphanumeric room code.
     */
    private function generateUniqueRoomCode(): string
    {
        do {
            $code = strtoupper(Str::random(6));
        } while (Room::where('room_code', $code)->exists());

        return $code;
    }

    /**
     * Find an active room by code.
     */
    public function findActiveRoomByCode(string $code): ?Room
    {
        return Room::where('room_code', strtoupper($code))
            ->where('status', 'active')
            ->first();
    }

    /**
     * Update room status.
     */
    public function updateStatus(Room $room, string $status): bool
    {
        return $room->update(['status' => $status]);
    }
}
