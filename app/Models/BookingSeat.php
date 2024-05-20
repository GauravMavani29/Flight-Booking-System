<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSeat extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function seatSchedule()
    {
        return $this->belongsTo(SeatSchedule::class);
    }
}
