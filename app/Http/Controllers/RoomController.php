<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'number' => 'required|unique:rooms',
            'type' => 'required',
            'price_per_night' => 'required|numeric',
            'status' => 'required',
        ]);

        $room = Room::create([
            'number' => $request->number,
            'type' => $request->type,
            'price_per_night' => $request->price_per_night,
            'status' => $request->status,
        ]);

        return redirect()->route('rooms.create')->with('success', 'Стаята е създадена успешно');
    }
}
