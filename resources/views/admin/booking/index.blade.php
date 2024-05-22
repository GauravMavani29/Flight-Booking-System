@extends('admin.layouts.app')
@section('content')
    <div class="row align-items-center">
        <div class="mb-4 border-0">
            <div
                class="card-header no-bg d-flex align-items-center justify-content-between border-bottom flex-wrap bg-transparent py-3 px-0">
                <h3 class="fw-bold mb-0">All Bookings</h3>
                <a href={{ route('admin.permission.create') }} class="btn btn-primary btn-set-task w-sm-100 py-2 px-5"><i
                        class="icofont-plus-circle me-2 fs-6"></i>Add New Permission</a>
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
                                <tr>
                                    <td>{{ $booking->booking_number }}</td>
                                    <td>${{ number_format($booking->amount, 2) }}</td>
                                    <td>${{ number_format($booking->total_discount, 2) }}</td>
                                    <td>{{ $booking->booking_time }}</td>
                                    <td>{{ $booking->flightSchedule->slug }}</td>
                                    <td>
                                        @foreach ($booking->bookingSeats as $seat)
                                            {{ $seat->first_name }} {{ $seat->last_name }}
                                            ({{ $seat->seatSchedule->seat->number }}{{ $seat->seatSchedule->seat->alphabet }})
                                            <br>
                                        @endforeach
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @include('models.success_alert') --}}
