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
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .flight-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .flight-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            transition: background-color 0.3s ease;
        }

        .flight-item:hover {
            background-color: #f1f1f1;
        }

        .flight-info {
            display: flex;
            flex-direction: column;
        }

        .flight-route {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .flight-date {
            color: #777;
        }

        .flight-price {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
        }

        .book-button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .book-button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .flight-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .flight-price,
            .book-button {
                align-self: stretch;
            }

            .book-button {
                text-align: center;
            }
        }
    </style>

    <div class="container">
        <div class="flight-list">


            @forelse ($scheduleFlights as $item)
                @php
                    $departureDate = \Carbon\Carbon::parse($item->departure_date);
                    $arrivalDate = \Carbon\Carbon::parse($item->arrival_date);
                    $flightDuration = $arrivalDate->diff($departureDate);
                @endphp
                <div class="flight-item">
                    <div class="flight-info">
                        <span class="flight-route">
                            {{ $item->departureAirport->name }} ({{ $item->departureAirport->country }}) →
                            {{ $item->arrivalAirport->name }} ({{ $item->arrivalAirport->country }})
                        </span>
                        <span class="flight-date">{{ $item->departure_date }}</span>
                        <span class="flight-time">
                            {{ $flightDuration->h }} hours {{ $flightDuration->i }} minutes
                        </span>
                    </div>
                    <div class="flight-price">
                        ${{ $item->seatSchedules->min('price') }} - ${{ $item->seatSchedules->max('price') }}
                    </div>
                    <a href='{{ route('book-flight', $item->slug) }}' class="book-button">Book Now</a>
                </div>
            @empty
                <p>No flights available.</p>
            @endforelse


            <!-- More flight items as needed -->
        </div>
    </div>
</x-app-layout>
