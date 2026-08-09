<?php

namespace App\Services;

use App\Models\Room;
use App\Models\Song;
use Illuminate\Support\Facades\Http;
use Exception;

class SongService
{
    /**
     * Search YouTube and add a song to the room.
     */
    public function addSong(Room $room, string $videoId): Song
    {
        // Prevent duplicate in room
        if ($room->songs()->where('video_id', $videoId)->exists()) {
            throw new Exception('Song already exists in this room.');
        }

        $apiKey = env('YOUTUBE_API_KEY');
        if (!$apiKey) {
            throw new Exception('YouTube API key is not configured.');
        }

        $response = Http::get('https://www.googleapis.com/youtube/v3/videos', [
            'part' => 'snippet,contentDetails',
            'id' => $videoId,
            'key' => $apiKey,
        ]);

        if ($response->failed() || empty($response->json('items'))) {
            throw new Exception('Could not fetch song details from YouTube.');
        }

        $item = $response->json('items')[0];
        $snippet = $item['snippet'];
        $contentDetails = $item['contentDetails'];

        return $room->songs()->create([
            'video_id' => $videoId,
            'title' => $snippet['title'],
            'thumbnail' => $snippet['thumbnails']['default']['url'] ?? null,
            'channel' => $snippet['channelTitle'],
            'duration' => $this->convertYouTubeDuration($contentDetails['duration']),
        ]);
    }

    /**
     * Remove song from room.
     */
    public function removeSong(Song $song): void
    {
        $song->delete();
    }

    /**
     * Convert YouTube ISO 8601 duration to human readable format (e.g. 3:45)
     */
    private function convertYouTubeDuration(string $duration): string
    {
        $dateInterval = new \DateInterval($duration);
        $format = '%i:%S';
        if ($dateInterval->h > 0) {
            $format = '%h:%I:%S';
        }
        return $dateInterval->format($format);
    }
}
