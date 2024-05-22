<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        @media (max-width: 768px) {

            th,
            td {
                font-size: 14px;
                padding: 10px;
            }
        }

        .cancel-button {
            background-color: red;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        .cancel-message {
            color: red;
            font-weight: bold;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
    </style>

    <div class="container">
        <h1>Customer Bookings</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Booking Number</th>
                        <th>Amount</th>
                        <th>Total Discount</th>
                        <th>Booking Time</th>
                        <th>Flight Schedule</th>
                        <th>Seats</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        @php
                            $departureDate = \Carbon\Carbon::parse($booking->flightSchedule->departure_date);
                            $currentTime = \Carbon\Carbon::now();
                            $hoursDifference = $departureDate->diffInHours($currentTime);
                        @endphp
                        <tr>
                            <td>{{ $booking->booking_number }}</td>
                            <td>£{{ number_format($booking->amount, 2) }}</td>
                            <td>£{{ number_format($booking->total_discount, 2) }}</td>
                            <td>{{ $booking->booking_time }}</td>
                            <td>{{ $booking->flightSchedule->slug }}</td>
                            <td>
                                @foreach ($booking->bookingSeats as $seat)
                                    {{ $seat->first_name }} {{ $seat->last_name }}
                                    ({{ $seat->seatSchedule->seat->number }}{{ $seat->seatSchedule->seat->alphabet }})
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                @if ($hoursDifference > 72)
                                    <form action="{{ route('cancel-booking', $booking->id) }}" method="POST"
                                        onsubmit="return confirmCancel()">
                                        @csrf
                                        <button type="submit" class="cancel-button">Cancel Booking</button>
                                    </form>
                                @else
                                    <span class="cancel-message">Cannot cancel within 72 hours of departure</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmCancel() {
            return confirm('Are you sure you want to cancel this booking?');
        }
    </script>
</x-app-layout>
