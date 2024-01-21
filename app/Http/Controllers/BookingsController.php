<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingsController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();
    
        return view('bookings.index', compact('bookings'));
    }

    public function delete($id)
{
    $booking = Booking::find($id);
    if ($booking) {
        $booking->delete();
    }
    return redirect()->route('bookings.index')->with('success', 'Резервацията бе изтрита успешно.');
}

}
