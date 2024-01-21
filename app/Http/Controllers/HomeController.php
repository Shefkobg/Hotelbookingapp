<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Payment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
    
         if ($user->perms >= 1) {
        return redirect()->route('admindashboard');
    }
    
        return view('home');
    }

    public function payBooking(Request $request, $bookingId)
{
    $booking = Booking::find($bookingId);

    if (!$booking) {
        return redirect()->route('home')->with('error', 'Резервацията не беше намерена.');
    }

    $data = $request->validate([
        'payment_amount' => 'required|numeric|min:0',
    ]);

    if ($data['payment_amount'] <= 0) {
        return redirect()->route('home')->with('error', 'Сумата на вноската трябва да бъде по-голяма от нула.');
    }

    $totalPaid = $booking->payments->sum('amount');

    if ($totalPaid + $data['payment_amount'] > $booking->total_price) {
        return redirect()->route('home')->with('error', 'Общата сума на вноските не може да бъде по-голяма от общата цена на резервацията.');
    }

    $payment = new Payment([
        'booking_id' => $booking->id,
        'user_id' => auth()->user()->id,
        'amount' => $data['payment_amount'],
        'payment_date' => now(),
        'status' => 1, // Статус: платено
    ]);
    $payment->save();

    $totalPaid = $booking->payments->sum('amount');
    if ($totalPaid + $data['payment_amount'] >= $booking->total_price) {
        $booking->status = 1;
        $booking->save();
    }

    return redirect()->route('home')->with('success', 'Плащането бе успешно записано.');
}


    public function showReservations()
    {
        $user = auth()->user();
        $bookings = Booking::where('customer_id', $user->id)->get();
        return view('home', compact('bookings'));
    }

    public function showReservationForm()
    {
        $rooms = Room::all();
        $bookings = Booking::where('customer_id', auth()->user()->id)->get();
        $payments = Payment::where('user_id', auth()->user()->id)->get();
        return view('home', compact('rooms', 'bookings', 'payments'));
    }
    public function reserveRoom(Request $request)
    {
        $data = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);
    
        $room = Room::find($data['room_id']);
        $price_per_night = $room->price_per_night;
        $checkInDate = \Carbon\Carbon::parse($data['check_in_date']);
        $checkOutDate = \Carbon\Carbon::parse($data['check_out_date']);
        $total_price = $price_per_night * $checkInDate->diffInDays($checkOutDate);
    
        $existingBookings = Booking::where('room_id', $data['room_id'])
            ->where(function($query) use ($checkInDate, $checkOutDate) {
                $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                    ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate]);
            })
            ->get();
    
        if ($existingBookings->count() > 0) {
            return redirect()->route('home')->with('error', 'Стаята е заета за избрания период.')->withInput();
        }
    
        $booking = new Booking([
            'room_id' => $data['room_id'],
            'customer_id' => auth()->user()->id,
            'check_in_date' => $data['check_in_date'],
            'check_out_date' => $data['check_out_date'],
            'total_price' => $total_price,
        ]);
        $booking->save();
    
        return redirect()->route('home')->with('success', 'Стаята бе успешно резервирана.');
    }
    

}
