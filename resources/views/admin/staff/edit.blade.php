@extends('admin.layouts.app')
@section('content')
    <div class="row align-items-center">
        <div class="mb-4 border-0">
            <div
                class="card-header no-bg d-flex align-items-center justify-content-between border-bottom flex-wrap bg-transparent py-3 px-0">
                <h3 class="fw-bold mb-0">Staffs Edit</h3>
            </div>
        </div>
    </div> <!-- Row end  -->

    <div class="row g-3 d-flex justify-content-center mb-3">
        <div class="col-xl-4 col-lg-4">
            <div class="sticky-lg-top">
                <div class="card mb-3">
                    <div
                        class="card-header d-flex justify-content-between align-items-center border-bottom-0 bg-transparent py-3">
                        <h6 class="fw-bold m-0">Staff Edit</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.staff.update', $staff->id) }}" method="POST">
                            @method('PUT')
                            @csrf()
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $staff->name }}"
                                        required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ $staff->email }}"
                                        required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" value="{{ $staff->phone }}" name="phone">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Roles</label>
                                    <select class="form-select" size="0" aria-label="size 3 select example"
                                        name="role">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ $staff->getRole()?->id == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                <div class="col-md-12">
                                    <button type="submit"
                                        class="btn btn-primary btn-set-task w-sm-100 text-uppercase py-2 px-5">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
