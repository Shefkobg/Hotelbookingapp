<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'customer_id',
        'check_in_date',
        'check_out_date',
        'total_price',
        'status', // добавяме статус на резервацията
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function payments()
{
    return $this->hasMany(Payment::class);
}
}
