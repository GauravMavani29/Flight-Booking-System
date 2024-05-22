<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airplane;
use App\Models\Airport;
use App\Models\FlightSchedule;
use App\Models\Seat;
use App\Models\SeatSchedule;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    //

    public function scheduleFlights()
    {
        // $schduleseats = SeatSchedule::all();
        // foreach ($schduleseats as $schduleseat) {
        //     if ($schduleseat->seat->class == 'First Class') {
        //         $schduleseat->price = 1000;
        //     } elseif ($schduleseat->seat->class == 'Business Class') {
        //         $schduleseat->price = 500;
        //     } elseif ($schduleseat->seat->class == 'Economy Class') {
        //         $schduleseat->price = 200;
        //     }
        //     $schduleseat->save();
        // }
        $scheduleFlights = FlightSchedule::all();
        return view('admin.flight.schedule-flights', compact('scheduleFlights'));
    }

    public function create()
    {
        $airplanes = Airplane::all();
        $airports = Airport::all();
        return view('admin.flight.create', compact('airplanes', 'airports'));
    }

    public function store(Request $request)
    {
        $flight = Airplane::findOrFail($request->airplane_id);
        $schedule_flight = new FlightSchedule();
        $schedule_flight->airplane_id = $request->airplane_id;
        $schedule_flight->departure_id = $request->departure_id;
        $schedule_flight->arrival_id = $request->arrival_id;
        $schedule_flight->departure_date = $request->departure_date;
        $schedule_flight->arrival_date = $request->arrival_date;

        // append 10character slugh after flight name
        $schedule_flight->slug = $flight->name . substr(md5(time()), 0, 10);
        $schedule_flight->save();

        $seats = $flight->seats;
        foreach ($seats as $seat) {
            $schedule_flight->seatSchedules()->create([
                'flight_schedule_id' => $schedule_flight->id,
                'seat_id' => $seat->id,
                'price' => $request->price,
            ]);
        }

        return redirect()->route('admin.schedule-flights.index');
    }

    public function edit($id)
    {
        $airplanes = Airplane::all();
        $airports = Airport::all();
        $flight = FlightSchedule::findOrFail($id);
        return view('admin.flight.edit', compact('flight', 'airplanes', 'airports'));
    }

    public function update($id)
    {
        $flight = FlightSchedule::findOrFail($id);
        $flight->airplane_id = request()->airplane_id;
        $flight->departure_id = request()->departure_id;
        $flight->arrival_id = request()->arrival_id;
        $flight->departure_date = request()->departure_date;
        $flight->arrival_date = request()->arrival_date;
        $flight->save();

        return redirect()->route('admin.schedule-flights.index');
    }

    public function delete($id)
    {
        $flight = FlightSchedule::findOrFail($id);

        $flight->seatSchedules()->delete();

        $flight->bookings()->delete();

        $flight->delete();

        return response()->json(['id' => $id]);
    }

    public function show($slug)
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

        // return $seats;

        $sortedSeats = collect([
            'first class' => collect($seats->get('First Class', collect()))->sortKeys()->toArray(),
            'business class' => collect($seats->get('Business Class', collect()))->sortKeys()->toArray(),
            'economy class' => collect($seats->get('Economy Class', collect()))->sortKeys()->toArray(),
        ]);

        //Locked seats IS_LOCKED = 1
        $lockedScheduleSeats = $seatSchedules->filter(function ($seatSchedule) {
            return $seatSchedule->is_locked == 1;
        });

        return view('admin.flight.show', ['seats' => $sortedSeats, 'flight' => $flight, 'lockedScheduleSeats' => $lockedScheduleSeats]);
    }

    public function unlockSeat($id)
    {
        $seatSchedule = SeatSchedule::findOrFail($id);
        $seatSchedule->is_locked = 0;
        $seatSchedule->save();

        return redirect()->back();
    }

}
