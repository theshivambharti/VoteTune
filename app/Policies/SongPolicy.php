<?php

namespace App\Policies;

use App\Models\Song;
use App\Models\User;

class SongPolicy
{
    /**
     * Determine whether the user can manage the song.
     */
    public function manage(User $user, Song $song): bool
    {
        return $user->id === $song->room->user_id;
    }
}
