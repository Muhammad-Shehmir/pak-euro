@extends('layout.master')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center p-3 py-0">
            <h4 class="fw-bold py-3 mb-2"><a href="{{ url('dashboard') }}" class="text-muted fw-light">Dashboard </a><a
                    href="{{ url('dashboard') }}" class="text-muted fw-light"> / Reports</a><span class="color"> / Booking
            </h4></span>
            <div class="">
                <a href="{{ url('export-booking') . '?' . http_build_query(['date_from' => request()->date_from, 'date_to' => request()->date_to]) }}"
                    class="btn btn-secondary create-new btn-primary" type="button"><span><i
                            class="mdi mdi-microsoft-excel me-sm-1"></i>
                        <span class="d-none d-sm-inline-block">Excel</span></span></a>
                <button class="btn btn-secondary create-new btn-primary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" tabindex="0"
                    aria-controls="DataTables_Table_0" type="button"><span><i class="mdi mdi-filter-outline me-sm-1"></i>
                        <span class="d-none d-sm-inline-block">Filters</span></span></button>
            </div>
        </div>


        <div class="card-body">
            <div class="card mb-2 w-100">
                <div class="collapse" id="collapseExample">
                    <div class="d-grid p-3 border">
                        <form method="GET" id="myForm" action="{{ url('/booking-reports') }}"
                            enctype="multipart/form-data" id="formValidationExamples" class="row g-3">
                            @csrf
                            <div class="col-md-2">
                                <div class="input-group input-group-merge">
                                    <span id="dateTime" class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" class="form-control" id="date_from" name="date_from"
                                            placeholder="Date From" value="{{ request('date_from') }}" />
                                        <label for="date_from">Date From</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge">
                                    <span id="dateTime" class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" class="form-control" id="date_to" name="date_to"
                                            placeholder="Date To" value="{{ request('date_to') }}" />
                                        <label for="date_to">Date To</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end p-3 py-0">
                                <button class="btn btn-secondary create-new btn-primary" tabindex="0"
                                    type="submit"><span><i class="mdi mdi-magnify"></i>
                                        <span class="d-none d-sm-inline-block">Search</span></span></button>
                                <a href="{{ url('/booking-reports') }}" class="btn btn-danger"
                                    tabindex="0"><span><i class="mdi mdi-close"></i>
                                        <span class="d-none d-sm-inline-block">Clear</span></span></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-datatable table-responsive p-3">
                <table class="datatables-basic table table-bordered">
                    <thead>
                        <tr>

                            <th>
                                <h6>Name</h6>
                            </th>
                            <th>
                                <h6>Check in Date</h6>
                            </th>
                            <th>
                                <h6>Check Out Date</h6>
                            </th>
                            <th>
                                <h6>Room Name</h6>
                            </th>
                            <th>
                                <h6>No of Nights</h6>
                            </th>
                        </tr>
                    </thead>
                </table>

            </div>

        </div>
    </div>
@endsection
