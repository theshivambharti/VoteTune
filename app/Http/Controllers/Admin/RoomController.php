<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('host')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.rooms', compact('rooms'));
    }
}
