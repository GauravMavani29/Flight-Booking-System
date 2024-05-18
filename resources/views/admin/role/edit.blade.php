@extends('admin.layouts.app')
@section('content')
    <div class="row align-items-center">
        <div class="mb-4 border-0">
            <div
                class="card-header no-bg d-flex align-items-center justify-content-between border-bottom flex-wrap bg-transparent py-3 px-0">
                <h3 class="fw-bold mb-0">Role Edit</h3>
            </div>
        </div>
    </div> <!-- Row end  -->

    <div class="row g-3 d-flex justify-content-center mb-3">
        <div class="col-xl-12 col-lg-12">
            <div class="sticky-lg-top">
                <div class="card mb-3">
                    <div
                        class="card-header d-flex justify-content-between align-items-center border-bottom-0 bg-transparent py-3">
                        <h6 class="fw-bold m-0">Role Information</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.role.update', $role->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="g-3">
                                <div class="col-md-12">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $role->name }}"
                                        placeholder="Name" required>
                                </div>
                                <h4 class="m-2 mt-3">Permissions</h4>
                                @php
                                    $permission_groups = \App\Models\Permission::all()->groupBy('section');
                                @endphp
                                <hr>
                                @foreach ($permission_groups as $key => $permission_group)
                                    <div class="card mb-2">
                                        <h5 class="card-header">
                                            {{ Str::headline($permission_group[0]['section']) }}</h5>
                                        <div class="row card-body d-flex justify-content-start align-items-center flex-row">
                                            @foreach ($permission_group as $key => $permission)
                                                <div class="col-lg-2 col-md-3 col-sm-4 col-6 col-xs-6">
                                                    <div
                                                        class="form-check form-switch d-flex justify-content-start flex-column align-items-center permission-box mt-1 mb-2 border p-2">
                                                        <label class="form-check-label"
                                                            for="Eaten-switch1">{{ $permission->name }}</label>
                                                        <input class="form-check-input" type="checkbox" id="Eaten-switch1"
                                                            name="permissions[]" value="{{ $permission->id }}"
                                                            @if ($role->hasPermissionTo($permission->name)) checked @endif>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-12">
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
