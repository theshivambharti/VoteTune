<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->after('id');
            $table->string('display_name')->nullable()->after('name');
            $table->string('avatar')->nullable()->after('email_verified_at');
            $table->string('provider')->nullable()->after('password');
            $table->string('provider_id')->nullable()->after('provider');
            $table->string('account_status')->default('active')->after('provider_id');
            $table->timestamp('last_login_at')->nullable()->after('account_status');
            $table->string('last_login_ip')->nullable()->after('last_login_at');
            $table->softDeletes();
            
            // Make password nullable for socialite users
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'uuid',
                'display_name',
                'avatar',
                'provider',
                'provider_id',
                'account_status',
                'last_login_at',
                'last_login_ip'
            ]);
            $table->dropSoftDeletes();
            
            // Note: Cannot easily revert password to non-nullable if there are nulls, 
            // but for a fresh migration we can.
            $table->string('password')->nullable(false)->change();
        });
    }
};
