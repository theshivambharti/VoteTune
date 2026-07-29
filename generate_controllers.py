import os

controllers = {
    'app/Http/Controllers/Auth/AuthController.php': r"""<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Services\AuthenticationService;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    protected $authService;

    public function __construct(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if ($this->authService->login($request->only('email', 'password'), $request->boolean('remember'))) {
            return redirect()->intended(route('dashboard'));
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->authService->register($request->validated());
        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        $this->authService->logout();
        return redirect('/');
    }
}
""",
    'app/Http/Controllers/Auth/SocialAuthController.php': r"""<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Services\SocialAuthenticationService;

class SocialAuthController extends BaseController
{
    protected $socialAuthService;

    public function __construct(SocialAuthenticationService $socialAuthService)
    {
        $this->socialAuthService = $socialAuthService;
    }

    public function redirect(string $provider)
    {
        return $this->socialAuthService->redirect($provider);
    }

    public function callback(string $provider)
    {
        try {
            $this->socialAuthService->callback($provider);
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Authentication failed: ' . $e->getMessage());
        }
    }
}
""",
    'app/Http/Controllers/User/ProfileController.php': r"""<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Services\UserService;
use App\Http\Requests\User\ProfileUpdateRequest;
use App\Http\Requests\User\PasswordUpdateRequest;
use Illuminate\Http\Request;

class ProfileController extends BaseController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function edit(Request $request)
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $this->userService->updateProfile($request->user(), $request->validated());
        return back()->with('success', 'Profile updated successfully.');
    }
    
    public function updatePassword(PasswordUpdateRequest $request)
    {
        $this->userService->updatePassword($request->user(), $request->password);
        return back()->with('success', 'Password updated successfully.');
    }
}
""",
    'app/Http/Controllers/DashboardController.php': r"""<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('Administrator')) {
            return view('admin.dashboard');
        } elseif ($user->hasRole('Host')) {
            return view('host.dashboard');
        }
        
        return view('user.dashboard');
    }
}
"""
}

os.makedirs('app/Http/Controllers/Auth', exist_ok=True)
os.makedirs('app/Http/Controllers/User', exist_ok=True)
for path, content in controllers.items():
    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)
        
print("Controllers generated.")
