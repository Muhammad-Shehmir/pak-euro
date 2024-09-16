@extends('layout.master')

@section('content')
    <!-- Content -->



    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center p-3 py-0">
            <h4 class="fw-bold py-3 mb-2"><a href="{{ url('dashboard') }}" class="text-muted fw-light">Dashboard /
                    Reports</a><span class="color"> / Procedure
            </h4></span>
            <div class="">

                <a href="{{ url('export-procedure') . '?' . http_build_query(['mr_no' => request()->mr_no, 'date_from' => request()->date_from, 'date_to' => request()->date_to, 'name' => request()->name, 'doctor_name' => request()->doctor_name, 'phone_no' => request()->phone_no]) }}"
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
            <div class="card mb-2">
                <div class="collapse" id="collapseExample">
                    <div class="d-grid p-3 border">
                        <form method="GET" id="myForm" action="{{ url('/procedure-reports') }}"
                            enctype="multipart/form-data" id="formValidationExamples" class="row g-3">
                            @csrf
                            <div class="col-md-4">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="mdi mdi-account-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" value="{{ request('name') }}"
                                            class="form-control name-validate" id="basic-icon-default-fullname"
                                            placeholder="Enter Name" name="name" aria-label="Enter Name"
                                            aria-describedby="basic-icon-default-fullname2" />
                                        <label for="basic-icon-default-fullname"> Name</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-name" style="display: none;">
                                    <i class="mdi mdi-alert"></i> Name is invalid
                                </span>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-merge">
                                    <span id="dateTime" class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" class="form-control" id="date_from" name="date_from"
                                            placeholder="Date From" value="{{ request('date_from') }}" />
                                        <label for="date_from">Date From</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-merge">
                                    <span id="dateTime" class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" class="form-control" id="date_to" name="date_to"
                                            placeholder="Date To" value="{{ request('date_to') }}" />
                                        <label for="date_to">Date To</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end  p-1 py-1">
                                <button class="btn btn-secondary create-new btn-primary" tabindex="0"
                                    type="submit"><span><i class="mdi mdi-magnify"></i>
                                        <span class="d-none d-sm-inline-block">Search</span></span></button>
                                <a href="{{ url('/procedure-reports') }}" class="btn btn-danger" tabindex="0"><span><i
                                            class="mdi mdi-close"></i>
                                        <span class="d-none d-sm-inline-block">Clear</span></span></a>
                                {{-- </div> --}}
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
                                <h6>ID</h6>
                            </th>
                            <th>
                                <h6>Name</h6>
                            </th>
                            <th>
                                <h6>Price</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($procedures as $procedure)
                            <tr>
                                <td>{{ $procedure->id }}</td>
                                <td>{{ $procedure->name }}</td>
                                <td>Rs. {{ $procedure->price }}</td>
                                {{-- <td>{{ $procedure->department }}</td>
                                <td>{{ $procedure->doctor->name }}</td>
                                <td>{{ $procedure->share }}</td> --}}
                                {{-- <td>
                                    <div class="d-flex align-items-center">
                                        <a class="btn btn-primary me-2 p-2-5"
                                            href="{{ url('/procedure/edit/' . $procedure->id) }}"><i
                                                class="fa fa-edit"></i>
                                        </a>
                                        <form method="post" action="{{ url('/procedure/delete/' . $procedure->id) }}">
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

            <div class="card-footer d-flex justify-content-end">
                <div class="mb-3">
                    <select id="perPage" name="perPage" class="form-select" onchange="changePerPage(this)">
                        <option value="5" @if ($perPage == 5) selected @endif>5</option>
                        <option value="10" @if ($perPage == 10) selected @endif>10</option>
                        <option value="15" @if ($perPage == 15) selected @endif>15</option>
                        <option value="25" @if ($perPage == 25) selected @endif>25</option>
                    </select>
                    <label for="perPage" class="form-label">Items per page:</label>

                </div>

                {{ $procedures->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </div>
    <script>
        function changePerPage(select) {
            const perPage = select.value;
            window.location.href = `{{ url('procedure') }}?perPage=${perPage}`;
        }
    </script>
@endsection
