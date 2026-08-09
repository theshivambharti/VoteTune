<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        if ($user->hasRole('Administrator')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('Host')) {
            return redirect()->route('host.dashboard');
        }
        
        return redirect()->route('user.dashboard');
    }
}
