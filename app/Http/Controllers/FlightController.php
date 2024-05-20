<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingSeat;
use App\Models\FlightSchedule;
use App\Models\Seat;
use App\Models\SeatSchedule;
use Illuminate\Http\Request;

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

        // return $seats;

        $sortedSeats = collect([
            'first class' => collect($seats->get('First Class', collect()))->sortKeys()->toArray(),
            'business class' => collect($seats->get('Business Class', collect()))->sortKeys()->toArray(),
            'economy class' => collect($seats->get('Economy Class', collect()))->sortKeys()->toArray(),
        ]);

        return view('book-flight', ['seats' => $sortedSeats, 'flight' => $flight]);
    }

    public function storeBooking(Request $req, $slug)
    {
        $isRandom = 0;
        if ($req->is_random == 1) {
            $isRandom = 1;
            $flight = FlightSchedule::where('slug', $slug)
                ->firstOrFail();
            // count number of seats from
            $seatCount = $req->input('seatCount');
            return view('passenger-information', ['flight' => $flight, 'isRandom' => $isRandom, 'seatCount' => $seatCount]);
        } else {
            $isRandom = 0;
            $seatCount = $req->input('seatCount');
            $flight = FlightSchedule::where('slug', $slug)
                ->firstOrFail();

            $seat_ids = $req->input('seats');

            $seats = SeatSchedule::where('flight_schedule_id', $flight->id)
                ->whereIn('seat_id', $seat_ids)
                ->get();

            // set is_lock == 1

            $seats->each(function ($seat) {
                $seat->is_locked = 1;
                $seat->locked_at = now();
                $seat->save();
            });

            // Collect seat classes
            foreach ($seats as $seat) {
                $seatClasses[] = $seat->seat->class;
            }

            return view('passenger-information', ['seats' => $seats, 'flight' => $flight, 'isRandom' => $isRandom, 'seatCount' => $seatCount, 'seatClasses' => $seatClasses]);
        }

    }

    public function storePassengerInfo(Request $req, $slug)
    {

        // Retrieve the flight schedule
        $flight = FlightSchedule::where('slug', $slug)->firstOrFail();

        // Create a new booking
        $booking = new Booking();
        $booking->user_id = auth()->id(); // Assuming user is authenticated
        $booking->flight_schedule_id = $flight->id;
        $booking->booking_number = $this->generateBookingNumber();
        $booking->amount = 0; // Initialize amount
        $booking->total_discount = 0; // Initialize total discount
        $booking->booking_time = now();
        $booking->save();

        $totalAmount = 0;
        $totalDiscount = 0;

        // Create booking seats entries
        foreach ($req->input('passengers') as $passenger) {
            $seatSchedule = SeatSchedule::where('flight_schedule_id', $flight->id)
                ->where('seat_id', $passenger['seat'])
                ->firstOrFail();

            // Calculate the age
            $dob = new \DateTime($passenger['dob']);
            $today = new \DateTime();
            $age = $today->diff($dob)->y;

            // Apply discount if the passenger is 15 years or younger
            $discount = 0;
            if ($age <= 15) {
                $discount = $seatSchedule->price * 0.25;
            }

            $finalAmount = $seatSchedule->price - $discount;

            $bookingSeat = new BookingSeat();
            $bookingSeat->booking_id = $booking->id;
            $bookingSeat->seat_schedule_id = $seatSchedule->id;
            $bookingSeat->first_name = $passenger['firstname'];
            $bookingSeat->last_name = $passenger['lastname'];
            $bookingSeat->dob = $passenger['dob'];
            $bookingSeat->discount = $discount;
            $bookingSeat->final_amount = $finalAmount;
            $bookingSeat->save();

            // Update total amount and discount
            $totalAmount += $finalAmount;
            $totalDiscount += $discount;

            // Mark the seat as booked
            $seatSchedule->is_booked = 1;
            $seatSchedule->save();
        }

        // Update booking with the total amount and discount
        $booking->amount = $totalAmount;
        $booking->total_discount = $totalDiscount;
        $booking->save();

        return redirect()->route('index');
    }

    private function generateBookingNumber()
    {
        return rand(100000, 999999); // Simple random number for booking number
    }

}
