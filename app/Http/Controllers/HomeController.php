<?php

namespace App\Http\Controllers;

use App\Models\FlightSchedule;

class HomeController extends Controller
{
    public function index()
    {
        $scheduleFlights = FlightSchedule::where('is_active', 1)
            ->with(['departureAirport', 'arrivalAirport', 'seatSchedules'])
            ->get();
        return view('index', compact('scheduleFlights'));
    }
}
