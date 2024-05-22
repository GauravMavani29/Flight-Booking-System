<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatSchedule extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = [
        'flight_schedule_id',
        'seat_id',
        'status',
        'price',
    ];

    public function flightSchedule()
    {
        return $this->belongsTo(FlightSchedule::class, 'flight_schedule_id');
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    public function bookingSeats()
    {
        return $this->hasMany(BookingSeat::class);
    }
}
