@extends('admin.layouts.app')
@section('content')
    <div class="row align-items-center">
        <div class="mb-4 border-0">
            <div
                class="card-header no-bg d-flex align-items-center justify-content-between border-bottom flex-wrap bg-transparent py-3 px-0">
                <h3 class="fw-bold mb-0">All Permissions</h3>
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
                                <th>#</th>
                                <th>Name</th>
                                <th>Section</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $key => $permission)
                                <tr id="row-{{ $permission->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->section }}</td>
                                    <td>
                                        <a href="{{ route('admin.permission.edit', $permission->id) }}"
                                            class="btn btn-primary btn-sm"><i class="icofont-edit"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm confirm-delete"
                                            data-href="{{ route('admin.permission.destroy', $permission->id) }}"><i
                                                class="icofont-trash"></i></a>
                                    </td>
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
