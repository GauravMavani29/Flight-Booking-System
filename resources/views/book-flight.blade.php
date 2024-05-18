<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <style>
        .seat {
            margin: 5px;
            display: inline-block;
        }

        .first-class {
            background-color: #007bff;
            border-radius: 6px;
        }

        .business-class {
            border-radius: 6px;
            background-color: #ffc107;
        }

        .economy-class {
            border-radius: 6px;
            background-color: #28a745;
        }

        .seat label {
            display: block;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 30px;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
            position: relative;
        }

        .seat input[type="checkbox"] {
            display: none;
        }

        .seat input[type="checkbox"]:checked+label {
            background-color: #ffffff;
            color: rgb(0, 0, 0);
        }

        .locked label {
            background-color: #6c757d;
            /* Grey for locked seats */
            cursor: not-allowed;
        }

        .booked label {
            background-color: #000;
            /* Black for booked seats */
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .seat label {
                width: 25px;
                height: 25px;
                line-height: 25px;
            }
        }

        .row-container {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }

        .info-box {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .info-color {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 5px;
            vertical-align: middle;
        }

        .locked-info {
            background-color: #6c757d;
        }

        .booked-info {
            background-color: #000;
        }

        .seat-limit-box {
            margin-bottom: 20px;
            text-align: center;
        }

        .seat-limit-box input {
            width: 50px;
            text-align: center;
        }

        .fire-exit-label {
            font-weight: bold;
            color: red;
            margin-bottom: 5px;
        }

        label {
            cursor: pointer;
        }

        .disabled {
            pointer-events: none;
        }

        .tooltip {
            display: none;
            position: absolute;
            background-color: black;
            color: white;
            padding: 5px;
            border-radius: 5px;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            z-index: 10;
        }

        .seat label:hover .tooltip {
            display: block;
        }
    </style>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Flight {{ $flight->name }} Seat Selection</h1>

        <div class="info-box">
            <p>
                <span class="info-color locked-info"></span> Locked seats
                <span class="info-color booked-info" style="margin-left: 20px;"></span> Booked seats
            </p>
        </div>

        <div class="seat-limit-box">
            <label for="seatCount">Select number of seats (max 6): </label>
            <input type="number" id="seatCount" name="seatCount" min="1" max="6" value="1">
        </div>

        @foreach (['first class', 'business class', 'economy class'] as $class)
            @if (!empty($seats[$class]))
                <div class="col-12 text-center mb-4">
                    <h5>{{ ucfirst($class) }}</h5>
                    @foreach ($seats[$class] as $number => $rowSeats)
                        @php
                            $isNearExitRow = false;
                            foreach ($rowSeats as $seat) {
                                if ($seat['is_near_exit']) {
                                    $isNearExitRow = true;
                                    break;
                                }
                            }
                        @endphp
                        @if ($isNearExitRow)
                            <div class="fire-exit-label">Fire Exit</div>
                        @endif
                        <div class="row-container">
                            @foreach ($rowSeats as $seat)
                                <div
                                    class="seat {{ str_replace(' ', '-', strtolower($seat['class'])) }} {{ $seat['is_locked'] ? 'locked disabled' : '' }} {{ $seat['is_booked'] ? 'booked disabled' : '' }}">
                                    <input type="checkbox" id="seat{{ $seat['id'] }}" class="seat-checkbox"
                                        {{ $seat['is_locked'] || $seat['is_booked'] ? 'disabled' : '' }}>
                                    <label
                                        for="seat{{ $seat['id'] }}">{{ $seat['number'] }}{{ $seat['alphabet'] }}<span
                                            class="tooltip">£{{ $seat['price'] }}</span></label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const seatCheckboxes = document.querySelectorAll('.seat-checkbox');
            const seatCountInput = document.getElementById('seatCount');

            seatCountInput.addEventListener('change', resetAndApplySeatLimit);

            seatCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', handleCheckboxChange);
            });

            function resetAndApplySeatLimit() {
                const maxSeats = parseInt(seatCountInput.value);

                seatCheckboxes.forEach(checkbox => {
                    if (!checkbox.disabled) {
                        checkbox.checked = false;
                    }
                    checkbox.disabled = false;
                });

                updateSeatLimit(maxSeats);
            }

            function updateSeatLimit(maxSeats) {
                let selectedSeats = document.querySelectorAll('.seat-checkbox:checked').length;

                seatCheckboxes.forEach(checkbox => {
                    if (!checkbox.checked) {
                        checkbox.disabled = selectedSeats >= maxSeats;
                    }
                });
            }

            function handleCheckboxChange() {
                const maxSeats = parseInt(seatCountInput.value);
                let selectedSeats = document.querySelectorAll('.seat-checkbox:checked').length;

                seatCheckboxes.forEach(checkbox => {
                    if (!checkbox.checked) {
                        checkbox.disabled = selectedSeats >= maxSeats;
                    }
                });
            }

            updateSeatLimit(parseInt(seatCountInput.value)); // Initial call to set the initial state
        });
    </script>

</x-app-layout>
