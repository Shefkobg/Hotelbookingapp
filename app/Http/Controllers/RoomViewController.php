<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomViewController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('rooms', compact('rooms'));
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms')->with('success', 'Стаята бе успешно изтрита.');
    }
}
