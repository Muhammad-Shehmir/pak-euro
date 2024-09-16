@extends('layout.master')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center p-3 py-0">
            <h4 class="fw-bold pt-3 mb-2"><a href="{{ url('dashboard') }}" class="text-muted fw-light">Dashboard / </a><a
                    href="{{ url('dashboard') }}" class="text-muted fw-light">Report </a><span class="color">/ Patient
                    Report
            </h4></span>
            <div class="">
                <a href="{{ url('export-patient') . '?' . http_build_query(['mr_no' => request()->mr_no, 'date_from' => request()->date_from, 'date_to' => request()->date_to, 'name' => request()->name, 'doctor_name' => request()->doctor_name, 'phone_no' => request()->phone_no]) }}"
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
                        <form method="GET" id="myForm" action="{{ url('/patient-reports') }}"
                            enctype="multipart/form-data" id="formValidationExamples" class="row g-3">
                            @csrf
                            <div class="col-md-2">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-numeric"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input name="mr_no" type="text" id="basic-icon-default-phone"
                                            class="form-control" value="{{ request('mr_no') }}"
                                            placeholder="Enter Your Number" aria-label="Enter Phone No."
                                            aria-describedby="basic-icon-default-phone2" />
                                        <label for="basic-icon-default-phone">MR No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="mdi mdi-account-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control name-validate"
                                            value="{{ request('name') }}" id="basic-icon-default-fullname"
                                            placeholder="Enter Name" name="name" aria-label="Enter Name"
                                            aria-describedby="basic-icon-default-fullname2" />
                                        <label for="basic-icon-default-fullname">Patient Name</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-name" style="display: none;">
                                    <i class="mdi mdi-alert"></i> Name is invalid
                                </span>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-phone"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input name="phone_no" type="text" id="basic-icon-default-phone"
                                            class="form-control phone-mask number-validate"
                                            value="{{ request('phone_no') }}" placeholder="Enter Your Number"
                                            aria-label="Enter Phone No." aria-describedby="basic-icon-default-phone2" />
                                        <label for="basic-icon-default-phone">Phone No</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-number" style="display: none;">
                                    <i class="mdi mdi-alert"></i> Number is invalid
                                </span>
                            </div>

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
                                <a href="{{ url('/patient-reports') }}" class="btn btn-danger" tabindex="0"><span><i
                                            class="mdi mdi-close"></i>
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
                                <h6>MR No.</h6>
                            </th>
                            <th>
                                <h6>Name</h6>
                            </th>
                            <th>
                                <h6>Phone No.</h6>
                            </th>
                            {{-- <th>
                                <h6>CNIC</h6>
                            </th> --}}
                            {{-- <th>
                                <h6>Type</h6>
                            </th> --}}
                            {{-- <th>
                                <h6>Actions</h6>
                            </th> --}}
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patients as $index => $patient)
                            <tr>
                                <td>{{ $patient->mr_number }}</td>
                                <td>{{ $patient->name }}</td>
                                <td>{{ $patient->phone_no }}</td>
                                {{-- <td>{{ $patient->cnic }}</td> --}}
                                {{-- <td>{{ $patient->patient_type->name }}</td> --}}
                                {{-- <td>
                                    <div class="d-flex align-items-center">
                                        <a class="btn btn-warning me-2 p-2-5"
                                            href="{{ url('/patient-profile' . '/' . $patient->id) }}"><i
                                                class="fa-solid fa-eye"></i>
                                        </a>
                                        <a class="btn btn-primary me-2 p-2-5"
                                            href="{{ url('/patient/edit/' . $patient->id) }}"><i class="fa fa-edit"></i>
                                        </a>
                                        <form method="post" action="{{ url('/patient/delete/' . $patient->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger p-2-5">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            <div class="card-footer d-flex justify-content-end align-items-end">
                <div class="mb-3 me-3">
                    <label for="perPage" class="form-label">Show Items:</label>
                    <select id="perPage" name="perPage" class="form-select" onchange="changePerPage(this)">
                        <option value="5" @if ($perPage == 5) selected @endif>5</option>
                        <option value="10" @if ($perPage == 10) selected @endif>10</option>
                        <option value="15" @if ($perPage == 15) selected @endif>15</option>
                        <option value="25" @if ($perPage == 25) selected @endif>25</option>
                    </select>
                </div>

                {{ $patients->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </div>
    <script>
        function changePerPage(select) {
            const perPage = select.value;
            window.location.href = `{{ url('patients') }}?perPage=${perPage}`;
        }
    </script>
@endsection
