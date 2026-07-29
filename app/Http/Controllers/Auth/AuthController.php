<?php
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
