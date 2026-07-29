import os

services = {
    'app/Services/AuthenticationService.php': r"""<?php
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
""",
    'app/Services/SocialAuthenticationService.php': r"""<?php
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
""",
    'app/Services/UserService.php': r"""<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
    public function updateProfile(User $user, array $data): bool
    {
        return $user->update($data);
    }

    public function updatePassword(User $user, string $newPassword): bool
    {
        return $user->update([
            'password' => Hash::make($newPassword)
        ]);
    }
}
""",
    'app/Services/RoleService.php': r"""<?php
namespace App\Services;

use App\Models\User;

class RoleService extends BaseService
{
    public function assignRole(User $user, string $role): void
    {
        $user->assignRole($role);
    }
    
    public function removeRole(User $user, string $role): void
    {
        $user->removeRole($role);
    }
}
""",
    'app/Services/PermissionService.php': r"""<?php
namespace App\Services;

class PermissionService extends BaseService
{
    // Placeholders for permission logic
}
""",
    'app/Services/SessionService.php': r"""<?php
namespace App\Services;

class SessionService extends BaseService
{
    // Logic for terminating specific active sessions can go here
}
"""
}

os.makedirs('app/Services', exist_ok=True)
for path, content in services.items():
    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)
        
print("Services generated.")
