<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Room;
use App\Models\Song;
use App\Models\Vote;
use Illuminate\Support\Str;

class VotingWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_host_can_create_room()
    {
        $host = User::factory()->create();
        
        $response = $this->actingAs($host)->post('/host/room', [
            'name' => 'My Awesome Party',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('rooms', [
            'name' => 'My Awesome Party',
            'user_id' => $host->id,
            'status' => 'active',
        ]);
    }

    public function test_host_can_add_song_to_room()
    {
        $host = User::factory()->create();
        $room = Room::factory()->create(['user_id' => $host->id]);

        // We should ideally mock the SongService HTTP call to YouTube, 
        // but for this unit test context, we assume the controller handles it.
        // Assuming we mock SongService or the Http facade in a real environment.
        \Illuminate\Support\Facades\Http::fake([
            'youtube/v3/videos*' => \Illuminate\Support\Facades\Http::response([
                'items' => [[
                    'snippet' => [
                        'title' => 'Test Song',
                        'channelTitle' => 'Test Channel',
                        'thumbnails' => ['default' => ['url' => 'http://example.com/thumb.jpg']],
                    ],
                    'contentDetails' => ['duration' => 'PT3M45S']
                ]]
            ], 200)
        ]);

        $response = $this->actingAs($host)->postJson("/host/room/{$room->id}/song", [
            'video_id' => 'dQw4w9WgXcQ'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('songs', [
            'room_id' => $room->id,
            'video_id' => 'dQw4w9WgXcQ'
        ]);
    }

    public function test_duplicate_song_prevention()
    {
        $host = User::factory()->create();
        $room = Room::factory()->create(['user_id' => $host->id]);
        $song = Song::factory()->create(['room_id' => $room->id, 'video_id' => 'dQw4w9WgXcQ']);

        $response = $this->actingAs($host)->postJson("/host/room/{$room->id}/song", [
            'video_id' => 'dQw4w9WgXcQ'
        ]);

        $response->assertStatus(422); // Validation/Exception error
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

    public function test_duplicate_authenticated_vote_is_prevented()
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();
        $song = Song::factory()->create(['room_id' => $room->id]);

        // First vote
        $this->actingAs($user)->postJson("/r/{$room->id}/song/{$song->id}/vote");
        
        // Un-vote
        $response = $this->actingAs($user)->postJson("/r/{$room->id}/song/{$song->id}/vote");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('votes', [
            'room_id' => $room->id,
            'song_id' => $song->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_cannot_vote_in_closed_room()
    {
        $room = Room::factory()->create(['status' => 'closed']);
        $song = Song::factory()->create(['room_id' => $room->id]);

        $response = $this->withCookie('voter_id', 'guest_123')->postJson("/r/{$room->id}/song/{$song->id}/vote");

        $response->assertStatus(403);
    }
}
