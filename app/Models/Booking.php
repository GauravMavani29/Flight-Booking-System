<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function bookingSeats()
    {
        return $this->hasMany(BookingSeat::class);
    }

    public function flightSchedule()
    {
        return $this->belongsTo(FlightSchedule::class);
    }

}
