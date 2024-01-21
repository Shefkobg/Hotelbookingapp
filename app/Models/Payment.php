<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    protected $fillable = ['booking_id', 'user_id', 'amount', 'payment_date'];
}