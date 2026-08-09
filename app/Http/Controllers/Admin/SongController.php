<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Song;

class SongController extends Controller
{
    public function index()
    {
        $songs = Song::with('room')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.songs', compact('songs'));
    }
}
