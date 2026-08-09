<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->cascadeOnDelete();
            $table->string('video_id')->index(); // YouTube video ID
            $table->string('title');
            $table->string('thumbnail')->nullable();
            $table->string('channel')->nullable();
            $table->string('duration')->nullable();
            $table->timestamps();

            // Typically a song shouldn't be added to the exact same room multiple times
            $table->unique(['room_id', 'video_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
