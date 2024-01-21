<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentsController extends Controller
{
    public function index()
    {
        $payments = Payment::all(); // Извличане на всички записи от таблицата за плащания

        return view('payments.index', compact('payments'));
    }
}
