<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vote;

class VoteController extends Controller
{
    public function index()
    {
        $votes = Vote::with(['user', 'song', 'room'])->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.votes', compact('votes'));
    }
}
