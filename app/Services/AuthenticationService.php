<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Password;

class AuthenticationService extends BaseService
{
    public function login(array $credentials, bool $remember = false): bool
    {
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            $user->update([
                'last_login_at' => now(),
                'last_login_ip' => request()->ip()
            ]);
            event(new Login('web', $user, $remember));
            session()->regenerate();
            return true;
        }
        return false;
    }

    public function register(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        
        $user->assignRole('User');
        event(new Registered($user));
        Auth::login($user);
        
        return $user;
    }

    public function logout(): void
    {
        $user = Auth::user();
        if ($user) {
            event(new Logout('web', $user));
        }
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }
}
