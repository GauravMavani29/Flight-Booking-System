@extends('admin.layouts.app')
@section('content')
    <div class="row align-items-center">
        <div class="mb-4 border-0">
            <div
                class="card-header no-bg d-flex align-items-center justify-content-between border-bottom flex-wrap bg-transparent py-3 px-0">
                <h3 class="fw-bold mb-0">Permission Info</h3>
            </div>
        </div>
    </div> <!-- Row end  -->

    <div class="row g-3 d-flex justify-content-center mb-3">
        <div class="col-xl-12 col-lg-12">
            <div class="sticky-lg-top">
                <div class="card mb-3">
                    <div
                        class="card-header d-flex justify-content-between align-items-center border-bottom-0 bg-transparent py-3">
                        <h6 class="fw-bold m-0">Permission Information</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.permission.store') }}" method="POST">
                            @csrf
                            <div class="g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        placeholder="Name" required>
                                </div>
                            </div>
                            <div class="g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label">Section Name</label>
                                    <input type="text" class="form-control" name="section" value="{{ old('section') }}"
                                        placeholder="Section" id="fillSelectValue" required>
                                </div>
                            </div>
                            <div class="g-3 mt-1">
                                <div class="col-md-12">
                                    <label class="form-label">Sections</label>
                                    <select id="fillSelect" class="form-control">
                                        <option value="">Select Section</option>
                                        @foreach ($permissions as $item)
                                            <option value="{{ $item->section }}">{{ $item->section }}</option>
                                        @endforeach
                                    </select>
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
