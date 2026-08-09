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
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('guest_session_id')->nullable();
            $table->timestamps();

            // Logged-in vote uniqueness
            $table->unique(['room_id', 'song_id', 'user_id'], 'unique_user_vote');

            // Guest vote uniqueness
            $table->unique(['room_id', 'song_id', 'guest_session_id'], 'unique_guest_vote');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
