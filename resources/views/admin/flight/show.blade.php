@extends('admin.layouts.app')
@section('content')
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

        .btn-submit {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-align: center;
            margin-top: 20px;
        }

        .btn-submit:disabled {
            background-color: #6c757d;
            cursor: not-allowed;
        }

        .text-center {
            text-align: center;
        }
    </style>
    <div class="row g-3 d-flex justify-content-center mb-3">
        <div class="col-xl-8 col-lg-8">
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
                                        <label for="seat{{ $seat['id'] }}">{{ $seat['number'] }}{{ $seat['alphabet'] }}
                                            <span class="tooltip">£{{ $seat['price'] }}</span></label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
        <div class="col-xl-4 col-lg-4">
            <h1>Locked Seats</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Seat</th>
                        <th>Action (UNLOCK)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lockedScheduleSeats as $seat)
                        <tr>
                            <td>{{ $seat->seat->number }}{{ $seat->seat->alphabet }}</td>
                            <td>
                                <a href="{{ route('admin.schedule-flights.unlock', $seat->id) }}" class="btn btn-danger"
                                    onclick="return confirmUnlock();">Unlock</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </div>
    </div>
    <script>
        function confirmUnlock() {
            return confirm('Are you sure you want to unlock this seat?');
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            const seatCheckboxes = document.querySelectorAll('.seat-checkbox');
            const fireExitCheckboxes = document.querySelectorAll('.seat-checkbox.is_near_exit');
            const seatCountInput = document.getElementById('seatCount');
            const randomSelectionCheckbox = document.getElementById('randomSelection');
            const avoidFireExitCheckbox = document.getElementById('avoidFireExit');
            const submitBtn = document.getElementById('submitBtn');
            const isRandomInput = document.getElementById('is_random');
            const fireExitResponsibility = document.getElementById('fireExitResponsibility');

            seatCountInput.addEventListener('change', resetAndApplySeatLimit);
            randomSelectionCheckbox.addEventListener('change', handleRandomSelectionChange);
            avoidFireExitCheckbox.addEventListener('change', handleFireExitChange);

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

                handleFireExitChange(); // Apply fire exit avoidance rule if necessary
                updateSeatLimit(maxSeats);
            }

            function updateSeatLimit(maxSeats) {
                let selectedSeats = document.querySelectorAll('.seat-checkbox:checked').length;

                seatCheckboxes.forEach(checkbox => {
                    if (!checkbox.checked) {
                        checkbox.disabled = selectedSeats >= maxSeats;
                    }
                });

                submitBtn.disabled = selectedSeats !== maxSeats && !randomSelectionCheckbox.checked;
            }

            function handleCheckboxChange() {
                const maxSeats = parseInt(seatCountInput.value);
                let selectedSeats = document.querySelectorAll('.seat-checkbox:checked').length;

                seatCheckboxes.forEach(checkbox => {
                    if (!checkbox.checked) {
                        checkbox.disabled = selectedSeats >= maxSeats;
                    }
                });

                submitBtn.disabled = selectedSeats !== maxSeats && !randomSelectionCheckbox.checked;
            }

            function handleRandomSelectionChange() {
                if (randomSelectionCheckbox.checked) {
                    seatCheckboxes.forEach(checkbox => {
                        checkbox.checked = false;
                        checkbox.disabled = true;
                    });
                    isRandomInput.value = '1';
                    submitBtn.disabled = false;
                } else {
                    resetAndApplySeatLimit();
                    isRandomInput.value = '0';
                }
            }

            function handleFireExitChange() {
                fireExitCheckboxes.forEach(checkbox => {
                    if (avoidFireExitCheckbox.checked) {
                        checkbox.checked = false;
                        checkbox.disabled = true;
                        fireExitResponsibility.value = '1';
                    } else if (!checkbox.closest('.seat').classList.contains('locked') && !checkbox.closest(
                            '.seat').classList.contains('booked')) {
                        checkbox.disabled = false;
                        fireExitResponsibility.value = '0';
                    }
                });
            }

            updateSeatLimit(parseInt(seatCountInput.value)); // Initial call to set the initial state

        });

        function submitForm() {
            const form = document.getElementById('book-flight');
            if (form) {
                form.submit();
            }
        }
    </script>
@endsection
{{-- @include('models.success_alert') --}}
