<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;

class SocialAuthenticationService extends BaseService
{
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider): User
    {
        $socialUser = Socialite::driver($provider)->user();

        $user = User::where('provider_id', $socialUser->getId())
                    ->orWhere('email', $socialUser->getEmail())
                    ->first();

        $isNew = false;
        if (!$user) {
            $isNew = true;
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User',
                'email' => $socialUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
                'email_verified_at' => now(),
            ]);
            $user->assignRole('User');
        } else {
            $user->update([
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar' => $user->avatar ?? $socialUser->getAvatar(),
            ]);
        }

        if ($isNew) {
            event(new Registered($user));
        }

        Auth::login($user);
        $user->update([
            'last_login_at' => now(),
            'last_login_ip' => request()->ip()
        ]);
        event(new Login('web', $user, false));
        session()->regenerate();

        return $user;
    }
}
