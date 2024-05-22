@extends('admin.layouts.app')
@section('content')
    <div class="row align-items-center">
        <div class="mb-4 border-0">
            <div
                class="card-header no-bg d-flex align-items-center justify-content-between border-bottom flex-wrap bg-transparent py-3 px-0">
                <h3 class="fw-bold mb-0">Flight Info</h3>
            </div>
        </div>
    </div> <!-- Row end  -->

    <div class="row g-3 d-flex justify-content-center mb-3">
        <div class="col-xl-12 col-lg-12">
            <div class="sticky-lg-top">
                <div class="card mb-3">
                    <div
                        class="card-header d-flex justify-content-between align-items-center border-bottom-0 bg-transparent py-3">
                        <h6 class="fw-bold m-0">Flight Information</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.schedule-flights.update', $flight->id) }}" method="POST">
                            @csrf
                            <div class="g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label">Airplanes</label>
                                    <select id="fillSelect" class="form-control" name="airplane_id">
                                        <option value="">Select Section</option>
                                        @foreach ($airplanes as $item)
                                            <option value="{{ $item->id }}"
                                                @if ($item->id == $flight->airplane_id) selected @endif>{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label">Departure Airport</label>
                                    <select id="fillSelect" class="form-control" name="departure_id">
                                        <option value="">Select Section</option>
                                        @foreach ($airports as $item)
                                            <option value="{{ $item->id }}"
                                                @if ($item->id == $flight->departure_id) selected @endif>{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label">Arrival Airport</label>
                                    <select id="fillSelect" class="form-control" name="arrival_id">
                                        <option value="">Select Section</option>
                                        @foreach ($airports as $item)
                                            <option value="{{ $item->id }}"
                                                @if ($item->id == $flight->arrival_id) selected @endif>{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label">Departure Date Time</label>
                                    <input type="datetime-local" class="form-control"
                                        name="departure_date"value="{{ $flight->departure_date }}" required>
                                </div>
                            </div>
                            <div class="g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label">Arrival Date Time</label>
                                    <input type="datetime-local" class="form-control" name="arrival_date"
                                        value="{{ $flight->arrival_date }}" required>
                                </div>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="col-md-12 mt-2">
                                <button type="submit"
                                    class="btn btn-primary btn-set-task w-sm-100 text-uppercase py-2 px-5">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
