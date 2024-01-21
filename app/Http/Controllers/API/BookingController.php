<?php

// app/Http/Controllers/API/BookingController.php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;

class BookingController extends Controller
{
    public function index()
    {
        return Booking::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'customer_id' => 'required|exists:users,id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'total_price' => 'required|numeric|min:0',
        ]);


        $booking = Booking::create($data);
        return $booking;
    }

    public function show(Booking $booking)
    {
        return $booking;
    }

    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'total_price' => 'required|numeric|min:0',
        ]);


        $booking->update($data);
        return $booking;
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->json(null, 204);
    }

    public function addPayment(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
        ]);

        $totalPaid = $booking->payments->sum('amount');

        if ($totalPaid + $data['amount'] > $booking->total_price) {
            return response()->json(['error' => 'Общата сума на вноските не може да бъде по-голяма от общата цена на резервацията.'], 400);
        }

        $payment = new Payment([
            'booking_id' => $booking->id,
            'user_id' => auth()->user()->id,
            'amount' => $data['amount'],
            'payment_date' => $data['payment_date'],
            'status' => 1, // Статус: платено
        ]);
        $payment->save();

        $totalPaid = $booking->payments->sum('amount');
        if ($totalPaid + $data['amount'] >= $booking->total_price) {
            $booking->status = 1;
            $booking->save();
        }

        return $payment;
    }
}
