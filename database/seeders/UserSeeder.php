<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::firstOrCreate(
            ['email' => 'admin@votetune.com'],
            [
                'name' => 'Admin User',
                'display_name' => 'Administrator',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('Administrator');

        $host = \App\Models\User::firstOrCreate(
            ['email' => 'host@votetune.com'],
            [
                'name' => 'Demo Host',
                'display_name' => 'DJ Host',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $host->assignRole('Host');

        $user = \App\Models\User::firstOrCreate(
            ['email' => 'user@votetune.com'],
            [
                'name' => 'Demo User',
                'display_name' => 'Cool User',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $user->assignRole('User');
    }
}
