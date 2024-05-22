@extends('admin.layouts.app')
@section('content')
    <div class="row align-items-center">
        <div class="mb-4 border-0">
            <div
                class="card-header no-bg d-flex align-items-center justify-content-between border-bottom flex-wrap bg-transparent py-3 px-0">
                <h3 class="fw-bold mb-0">All Schedule Flights</h3>
                <a href={{ route('admin.schedule-flights.create') }}
                    class="btn btn-primary btn-set-task w-sm-100 py-2 px-5"><i class="icofont-plus-circle me-2 fs-6"></i>Add
                    New Flight</a>
            </div>
        </div>
    </div> <!-- Row end  -->
    <div class="row g-3 mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" style="overflow-x: scroll;">
                    <table id="myDataTable" class="table-hover mb-0 table align-middle" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Departure Airport</th>
                                <th>Arrival Airport</th>
                                <th>Departure Date</th>
                                <th>Time</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($scheduleFlights as $item)
                                @php
                                    $departureDate = \Carbon\Carbon::parse($item->departure_date);
                                    $arrivalDate = \Carbon\Carbon::parse($item->arrival_date);
                                    // Calculate the difference in hours and minutes
                                    $totalMinutes = $arrivalDate->diffInMinutes($departureDate);
                                    $hours = intdiv($totalMinutes, 60);
                                    $minutes = $totalMinutes % 60;
                                @endphp
                                <tr id="row-{{ $item->id }}">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->departureAirport->name }} ({{ $item->departureAirport->country }})</td>
                                    <td> {{ $item->arrivalAirport->name }} ({{ $item->arrivalAirport->country }})</td>
                                    <td>{{ $item->departure_date }}</td>
                                    <td>{{ $hours }} hours, {{ $minutes }} minutes</td>
                                    <td> ${{ $item->seatSchedules->min('price') }} -
                                        ${{ $item->seatSchedules->max('price') }}</td>
                                    <td>
                                        @php
                                            $user = Auth::user();
                                            $userRole = $user->hasRole('Super Admin');
                                        @endphp

                                        @if ($user->hasRole('super-admin'))
                                            <a href="{{ route('admin.schedule-flights.edit', $item->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <a data-href="{{ route('admin.schedule-flights.delete', $item->id) }}"
                                                href="#" class="btn btn-danger btn-sm confirm-delete">Delete</a>
                                        @endif
                                        <a href="{{ route('admin.schedule-flights.show', $item->slug) }}"
                                            class="btn btn-success btn-sm">Show</a>
                                    </td>

                                </tr>
                            @empty
                                <p>No flights available.</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @include('models.success_alert') --}}
