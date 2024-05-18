@extends('admin.layouts.app')
@section('content')
    <style>
        .seat {
            margin: 5px;
            display: inline-block;
            /* Ensure seats are in line */
        }

        .first-class {
            background-color: #007bff;
            /* Blue for First Class */
        }

        .business-class {
            background-color: #ffc107;
            /* Yellow for Business Class */
        }

        .economy-class {
            background-color: #28a745;
            /* Green for Economy Class */
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
        }

        .seat input[type="checkbox"] {
            display: none;
        }

        .seat input[type="checkbox"]:checked+label {
            background-color: #000;
            /* Change background color to black when selected */
            color: white;
        }

        @media (max-width: 768px) {
            .seat label {
                width: 25px;
                height: 25px;
                line-height: 25px;
            }
        }

        .row-container {
            /* Add a flex container for each row */
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }
    </style>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Flight 1 Seat Selection</h1>
        @foreach (['first class', 'business class', 'economy class'] as $class)
            @if (!empty($seats[$class]))
                <div class="col-12 text-center mb-4">
                    <h5>{{ ucfirst($class) }}</h5>
                    {{-- sort data based on seat number                     --}}


                    @foreach ($seats[$class] as $number => $rowSeats)
                        <div class="row-container">
                            @foreach ($rowSeats as $seat)
                                <div class="seat {{ str_replace(' ', '-', strtolower($seat['class'])) }}">
                                    <input type="checkbox" id="seat{{ $seat['id'] }}">
                                    <label for="seat{{ $seat['id'] }}">{{ $seat['number'] }}{{ $seat['alphabet'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
@endsection
