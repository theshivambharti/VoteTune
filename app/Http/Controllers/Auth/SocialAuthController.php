<?php
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
