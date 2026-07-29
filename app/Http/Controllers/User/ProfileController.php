<?php
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
