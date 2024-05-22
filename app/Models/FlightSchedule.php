<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightSchedule extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'airplane_id',
        'departure_id',
        'arrival_id',
        'departure_date',
        'arrival_date',
        'slug',
    ];

    public function airplane()
    {
        return $this->belongsTo(Airplane::class);
    }

    public function departureAirport()
    {
        return $this->belongsTo(Airport::class, 'departure_id');
    }

    public function arrivalAirport()
    {
        return $this->belongsTo(Airport::class, 'arrival_id');
    }

    public function seatSchedules()
    {
        return $this->hasMany(SeatSchedule::class, 'flight_schedule_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
