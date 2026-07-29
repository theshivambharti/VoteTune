<?php
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
