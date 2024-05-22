<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingController extends Controller
{
    //
    public function bookings()
    {
        $bookings = Booking::all();
        return view('admin.booking.index', compact('bookings'));
    }
}
