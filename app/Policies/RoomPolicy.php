<?php

namespace App\Policies;

use App\Models\Room;
use App\Models\User;

class RoomPolicy
{
    /**
     * Determine whether the user can manage the room.
     */
    public function manage(User $user, Room $room): bool
    {
        return $user->id === $room->user_id;
    }
}
