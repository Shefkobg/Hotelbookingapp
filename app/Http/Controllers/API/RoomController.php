<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return response()->json(['rooms' => $rooms], 200);
    }

    public function show($id)
    {
        $room = Room::find($id);
        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);
        }
        return response()->json(['room' => $room], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'number' => 'required|unique:rooms',
            'type' => 'required',
            'price_per_night' => 'required|numeric',
            'status' => 'required',
        ]);

        $room = Room::create($validatedData);

        return response()->json(['room' => $room], 201);
    }

}
