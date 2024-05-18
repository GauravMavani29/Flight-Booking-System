<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatSchedule extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function flightSchedule()
    {
        return $this->belongsTo(FlightSchedule::class, 'flight_schedule_id');
    }
}
