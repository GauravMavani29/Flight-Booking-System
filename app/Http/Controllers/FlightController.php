<?php

namespace App\Http\Controllers;

use App\Models\FlightSchedule;
use App\Models\Seat;
use App\Models\SeatSchedule;

class FlightController extends Controller
{
    //

    public function bookFlight($slug)
    {
        $flight = FlightSchedule::where('slug', $slug)
            ->firstOrFail();

        $seats = Seat::where('airplane_id', $flight->airplane_id)
            ->orderBy('class')
            ->orderBy('number')
            ->orderBy('alphabet')
            ->get()
            ->groupBy(['class', 'number']);

        $seatSchedules = SeatSchedule::where('flight_schedule_id', $flight->id)->get();

        // Mark seats as locked, booked, or near exit
        $seats->each(function ($classSeats) use ($seatSchedules) {
            $classSeats->each(function ($seats, $number) use ($seatSchedules) {
                $seats->each(function ($seat) use ($seatSchedules) {
                    $schedule = $seatSchedules->firstWhere('seat_id', $seat->id);
                    if ($schedule) {
                        $seat->is_locked = isset($schedule->is_locked) ? $schedule->is_locked === '1' : false;
                        $seat->is_booked = isset($schedule->is_booked) ? $schedule->is_booked === '1' : false;
                        $seat->price = isset($schedule->price) ? $schedule->price : 0; // Include price
                    } else {
                        $seat->is_locked = false;
                        $seat->is_booked = false;
                        $seat->price = 0; // Default price if not set
                    }
                    $seat->is_near_exit = isset($seat->is_near_exit) ? $seat->is_near_exit === '1' : false;
                });
            });
        });

        $sortedSeats = collect([
            'first class' => collect($seats->get('First Class', collect()))->sortKeys()->toArray(),
            'business class' => collect($seats->get('Business Class', collect()))->sortKeys()->toArray(),
            'economy class' => collect($seats->get('Economy Class', collect()))->sortKeys()->toArray(),
        ]);

        return view('book-flight', ['seats' => $sortedSeats, 'flight' => $flight]);
    }

}
