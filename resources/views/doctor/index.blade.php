@extends('layout.master')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2"><a href="{{ url('dashboard') }}" class="text-muted fw-light">Dashboard /</a> Doctor</h4>

        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-header flex-column flex-md-row">
                <div class="head-label text-center">
                </div>
                <div class="dt-action-buttons text-end pt-3 pt-md-0">
                    <div class="dt-buttons btn-group flex-wrap">
                        <a href="{{ url('/doctor/add') }}" class="btn btn-secondary create-new btn-primary" tabindex="0"
                            aria-controls="DataTables_Table_0" type="button"><span><i class="mdi mdi-plus me-sm-1"></i>
                                <span class="d-none d-sm-inline-block">Add New Doctor</span></span></a>
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive pt-0 p-3">
                <table class="datatables-basic table table-bordered">
                    <thead>
                        <tr>
                            <th><h6>ID</h6></th>
                            <th><h6>Name</h6></th>
                            <th><h6>Type</h6></th>
                            <th><h6>Phone No.</h6></th>
                            <th><h6>CNIC</h6></th>
                            <th><h6>Address</h6></th>
                            <th><h6>Category ID</h6></th>
                            <th><h6>Actions</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctors as $doctor)
                            <tr>
                                <td>{{ $doctor->id }}</td>
                                <td>{{ $doctor->name }}</td>
                                <td>{{ $doctor->type }}</td>
                                <td>{{ $doctor->phone_no }}</td>
                                <td>{{ $doctor->cnic }}</td>
                                <td>{{ $doctor->address }}</td>
                                <td>{{ $doctor->category_id}}</td>
                                <td>
                                             <div class="d-flex align-items-center">
                                        <a class="btn btn-primary me-2 p-2-5" href="{{ url('/doctor/edit/' . $doctor->id) }}"><i
                                                class="fa fa-edit"></i> </a>
                                        <form method="post" action="{{ url('/doctor/delete/' . $doctor->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger p-2-5">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
