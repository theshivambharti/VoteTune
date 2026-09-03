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

        if (app()->environment(['local', 'testing', 'development'])) {
            $localUser = \App\Models\User::firstOrCreate(
                ['email' => 'test.user@votetune.local'],
                [
                    'name' => 'Local User',
                    'display_name' => 'Local Test User',
                    'password' => \Illuminate\Support\Facades\Hash::make('VoteTune@User2026!'),
                    'email_verified_at' => now(),
                ]
            );
            $localUser->assignRole('User');

            $localHost = \App\Models\User::firstOrCreate(
                ['email' => 'test.host@votetune.local'],
                [
                    'name' => 'Local Host',
                    'display_name' => 'Local Test Host',
                    'password' => \Illuminate\Support\Facades\Hash::make('VoteTune@Host2026!'),
                    'email_verified_at' => now(),
                ]
            );
            $localHost->assignRole('Host');

            $localAdmin = \App\Models\User::firstOrCreate(
                ['email' => 'test.admin@votetune.local'],
                [
                    'name' => 'Local Admin',
                    'display_name' => 'Local Test Admin',
                    'password' => \Illuminate\Support\Facades\Hash::make('VoteTune@Admin2026!'),
                    'email_verified_at' => now(),
                ]
            );
            $localAdmin->assignRole('Administrator');
        }
    }
}
