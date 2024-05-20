<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function bookings(Request $request, $userId)
    {
        $bookings = Booking::where('user_id', $userId)
            ->with(['flightSchedule', 'bookingSeats'])
            ->get();

        return view('bookings.index', compact('bookings'));
    }
    public function cancelBooking(Request $request, $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        $departureDate = Carbon::parse($booking->flightSchedule->departure_date);
        $currentTime = Carbon::now();
        $hoursDifference = $departureDate->diffInHours($currentTime);

        if ($hoursDifference <= 72) {
            return redirect()->back()->with('error', 'Cannot cancel within 72 hours of departure.');
        }

        // Add your cancellation logic here (e.g., mark as cancelled, refund, etc.)
        $booking->delete(); // Example of deleting the booking

        return redirect()->back()->with('success', 'Booking cancelled successfully.');
    }
}
