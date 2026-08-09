<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->cascadeOnDelete();
            $table->foreignId('song_id')->constrained()->cascadeOnDelete();
            
            // Nullable for guests
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('guest_session_id')->nullable();
            
            // A deterministic string to uniquely identify the voter (e.g. "user_5" or "guest_xyz123")
            // This prevents MySQL NULL index bypasses.
            $table->string('voter_identifier');
            
            $table->timestamps();

            // Single unified unique index
            $table->unique(['room_id', 'song_id', 'voter_identifier'], 'unique_room_song_voter');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
