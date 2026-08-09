<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;

class SongFactory extends Factory
{
    public function definition(): array
    {
        return [
            'room_id' => Room::factory(),
            'video_id' => $this->faker->regexify('[A-Za-z0-9_-]{11}'),
            'title' => $this->faker->sentence(),
            'thumbnail' => 'http://example.com/thumb.jpg',
            'channel' => $this->faker->name(),
            'duration' => '3:45',
        ];
    }
}
