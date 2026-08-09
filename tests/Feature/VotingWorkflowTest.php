<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Room;
use App\Models\Song;

class VotingWorkflowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Helper to create a user and assign the Host role if Spatie permissions are used.
     * Since this is a core requirement of Phase 9.1, we ensure the Host role exists.
     */
    protected function createHost()
    {
        $user = User::factory()->create();
        // Assume role exists or create it if Spatie is used
        if (class_exists(\Spatie\Permission\Models\Role::class)) {
            \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Host']);
            $user->assignRole('Host');
        }
        return $user;
    }

    public function test_authenticated_user_can_vote()
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();
        $song = Song::factory()->create(['room_id' => $room->id]);

        $response = $this->actingAs($user)->postJson("/r/{$room->id}/song/{$song->id}/vote");

        $response->assertStatus(200);
        $this->assertDatabaseHas('votes', [
            'room_id' => $room->id,
            'song_id' => $song->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_authenticated_user_cannot_create_a_duplicate_vote()
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();
        $song = Song::factory()->create(['room_id' => $room->id]);

        // First request = vote created
        $response1 = $this->actingAs($user)->postJson("/r/{$room->id}/song/{$song->id}/vote");
        $response1->assertStatus(200);
        
        $this->assertDatabaseCount('votes', 1);

        // Second request = no second database row (duplicate prevented)
        // Since we decoupled to explicit POST, calling POST again will hit the duplicate check
        $response2 = $this->actingAs($user)->postJson("/r/{$room->id}/song/{$song->id}/vote");
        $response2->assertStatus(422); // Handled by try-catch in VoteController
        
        $this->assertDatabaseCount('votes', 1); // Verify no duplicate row
    }

    public function test_authenticated_user_can_remove_their_vote()
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();
        $song = Song::factory()->create(['room_id' => $room->id]);

        // Create vote
        $this->actingAs($user)->postJson("/r/{$room->id}/song/{$song->id}/vote");
        
        // Remove vote
        $response = $this->actingAs($user)->deleteJson("/r/{$room->id}/song/{$song->id}/vote");
        $response->assertStatus(200);
        
        $this->assertDatabaseMissing('votes', [
            'room_id' => $room->id,
            'song_id' => $song->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_guest_can_vote()
    {
        $room = Room::factory()->create();
        $song = Song::factory()->create(['room_id' => $room->id]);

        $response = $this->withCookie('voter_id', 'guest_123')->postJson("/r/{$room->id}/song/{$song->id}/vote");

        $response->assertStatus(200);
        $this->assertDatabaseHas('votes', [
            'room_id' => $room->id,
            'song_id' => $song->id,
            'voter_identifier' => 'guest_123',
        ]);
    }

    public function test_guest_cannot_create_a_duplicate_vote()
    {
        $room = Room::factory()->create();
        $song = Song::factory()->create(['room_id' => $room->id]);

        // First request
        $response1 = $this->withCookie('voter_id', 'guest_123')->postJson("/r/{$room->id}/song/{$song->id}/vote");
        $response1->assertStatus(200);
        
        $this->assertDatabaseCount('votes', 1);

        // Second request
        $response2 = $this->withCookie('voter_id', 'guest_123')->postJson("/r/{$room->id}/song/{$song->id}/vote");
        $response2->assertStatus(422);
        
        $this->assertDatabaseCount('votes', 1);
    }

    public function test_guest_can_remove_their_vote()
    {
        $room = Room::factory()->create();
        $song = Song::factory()->create(['room_id' => $room->id]);

        $this->withCookie('voter_id', 'guest_123')->postJson("/r/{$room->id}/song/{$song->id}/vote");
        
        $response = $this->withCookie('voter_id', 'guest_123')->deleteJson("/r/{$room->id}/song/{$song->id}/vote");
        $response->assertStatus(200);
        
        $this->assertDatabaseMissing('votes', [
            'voter_identifier' => 'guest_123',
        ]);
    }

    public function test_closed_room_rejects_voting()
    {
        $room = Room::factory()->create(['status' => 'closed']);
        $song = Song::factory()->create(['room_id' => $room->id]);

        $response = $this->withCookie('voter_id', 'guest_123')->postJson("/r/{$room->id}/song/{$song->id}/vote");

        $response->assertStatus(403);
    }

    public function test_song_from_another_room_cannot_be_voted_on()
    {
        $roomA = Room::factory()->create();
        $roomB = Room::factory()->create();
        
        // Song belongs to Room A
        $songA = Song::factory()->create(['room_id' => $roomA->id]);

        // Attacking Room B with Song A
        $response = $this->withCookie('voter_id', 'guest_123')->postJson("/r/{$roomB->id}/song/{$songA->id}/vote");

        // The VoteService throws an Exception when song->room_id !== room->id
        $response->assertStatus(422);
        
        $this->assertDatabaseCount('votes', 0);
    }

    public function test_unauthorized_host_cannot_manage_another_hosts_room()
    {
        $hostA = $this->createHost();
        $hostB = $this->createHost();
        
        $roomA = Room::factory()->create(['user_id' => $hostA->id]);

        // Host B tries to view Host A's room management panel
        $response1 = $this->actingAs($hostB)->get("/host/room/{$roomA->room_code}");
        $response1->assertStatus(403); // Authorized by RoomPolicy

        // Host B tries to delete a song in Host A's room
        $songA = Song::factory()->create(['room_id' => $roomA->id]);
        $response2 = $this->actingAs($hostB)->deleteJson("/host/room/{$roomA->id}/song/{$songA->id}");
        $response2->assertStatus(403);
    }

    public function test_duplicate_youtube_song_is_rejected()
    {
        $host = $this->createHost();
        $room = Room::factory()->create(['user_id' => $host->id]);
        
        // Pre-existing song in the room
        $song = Song::factory()->create(['room_id' => $room->id, 'video_id' => 'dQw4w9WgXcQ']);

        // Attempting to add the same YouTube video again
        $response = $this->actingAs($host)->postJson("/host/room/{$room->id}/song", [
            'video_id' => 'dQw4w9WgXcQ'
        ]);

        $response->assertStatus(422);
        // Ensure no second song is added
        $this->assertDatabaseCount('songs', 1);
    }
}
