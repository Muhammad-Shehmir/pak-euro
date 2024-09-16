@extends('layout.master')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center p-3 py-0">
            <h4 class="fw-bold py-3 mb-2"><a href="{{ url('dashboard') }}" class="text-muted fw-light">Dashboard </a><span class="color">/ Lab Tracking
            </h4></span>
            <button class="btn btn-secondary create-new btn-primary" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" tabindex="0"
                aria-controls="DataTables_Table_0" type="button"><span><i class="mdi mdi-filter-outline me-sm-1"></i>
                    <span class="d-none d-sm-inline-block">Filters</span></span></button>
        </div>


        <div class="card-body">


            <div class="col-14">

                <div class="card mb-4">


                    <div class="collapse" id="collapseExample">
                        <div class="d-grid p-3 border">
                            <form method="GET" id="myForm" action="{{ url('/lab-tracking') }}"
                                enctype="multipart/form-data" id="formValidationExamples" class="row g-3">
                                @csrf
                                {{-- <div class="col-md-6">
                                    <div class="input-group input-group-merge mb-2">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="mdi mdi-account-outline"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text"  class="form-control name-validate" value="{{ request('name') }}"
                                                id="basic-icon-default-fullname" placeholder="Enter Name" name="name"
                                                aria-label="Enter Name" aria-describedby="basic-icon-default-fullname2" />
                                            <label for="basic-icon-default-fullname"> Name</label>
                                        </div>
                                    </div>
                                    <span class="text-danger validation-name" style="display: none;">
                                        <i class="mdi mdi-alert"></i> Name is invalid
                                    </span>
                                </div> --}}
                                <div class="col-md-4">
                                <div class="input-group input-group-merge mb-2  ">



                                    <span class="input-group-text" id="basic-addon-search31"><i
                                            class="mdi mdi-magnify"></i></span>
                                    <input type="text" class="form-control" placeholder="Search..."
                                        aria-label="Search..." aria-describedby="basic-addon-search31" />


                                </div>
                                </div>
                                <div class="col-md-4">

                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="date" type="date" id="basic-icon-default-phone"
                                            class="form-control" placeholder="YYYY-MM-DD" aria-label="YYYY-MM-DD"
                                            aria-describedby="basic-icon-default-phone2" />
                                        <label for="basic-icon-default-phone"> Date</label>
                                    </div>
                                </div>
                                </div>


                                <div class="col-md-4">

                                <div class="input-group input-group-merge mb-2">
                                    <div class="form-floating form-floating-outline ">
                                        <select required name="" type="text"
                                            class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value="">Select</option>
                                            <option value="Expenses">Expenses</option>
                                            <option value="In Expenses">In Expenses</option>

                                        </select>
                                    </div>
                                </div>
                                </div>
                                {{-- <div class="col-md-5"> --}}

                                <div class="d-flex justify-content-end  p-1 py-1">
                                    <button class="btn btn-secondary create-new btn-primary"  tabindex="0"
                                        type="submit"><span><i class="mdi mdi-magnify"></i>
                                            <span class="d-none d-sm-inline-block">Search</span></span></button>
                                    <a href="{{ url('/lab') }}"    class="btn btn-danger" tabindex="0"
                                        ><span><i class="mdi mdi-close"></i>
                                            <span class="d-none d-sm-inline-block">Clear</span></span></a>
                                </div>
                                {{-- </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-header flex-column flex-md-row">
                <div class="head-label text-center">
                </div>
                <div class="dt-action-buttons pt-3 pt-md-0">
                    <div class="dt-buttons btn-group flex-wrap">
                        <a href="{{ url('') }}" class="btn btn-secondary create-new btn-primary"
                            tabindex="0" aria-controls="DataTables_Table_0" type="button"><span><i
                                    class="mdi mdi-plus me-sm-1"></i>
                                <span class="d-none d-sm-inline-block">Add New</span></span></a>
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive pt-0 p-3">
                <table class="datatables-basic table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <h6>Patient Name</h6>
                            </th>
                            <th>
                                <h6>Lab Info</h6>
                            </th>
                            <th>
                                <h6>Phone No.</h6>
                            </th>
                            <th>
                                <h6>Work Name</h6>
                            </th>
                            <th>
                                <h6>Shade</h6>
                            </th>
                            <th>
                                <h6>Comment</h6>
                            </th>
                            <th>
                                <h6>Due Date</h6>
                            </th>
                            <th>
                                <h6>Status</h6>
                            </th>
                            <th>
                                <h6>Amount</h6>
                            </th>
                            <th>
                                <h6>Amount Due</h6>
                            </th>
                            <th>
                                <h6>Payement Status</h6>
                            </th>
                            <th>
                                <h6>Pay Field</h6>
                            </th>
                            <th>
                                <h6>Action</h6>
                            </th>

                        </tr>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            {{-- <div class="card-footer d-flex justify-content-end">
                <div class="mb-3">
                        <select id="perPage" name="perPage" class="form-select" onchange="changePerPage(this)">
                            <option value="5" @if($perPage == 5) selected @endif>5</option>
                            <option value="10" @if($perPage == 10) selected @endif>10</option>
                            <option value="15" @if($perPage == 15) selected @endif>15</option>
                            <option value="25" @if($perPage == 25) selected @endif>25</option>
                        </select>
                        <label for="perPage" class="form-label">Items per page:</label>
                    </div>
                {{ $labtracking->links('pagination::bootstrap-4') }}
            </div> --}}
        </div>
    </div>
    {{-- <script>
        function changePerPage(select) {
            const perPage = select.value;
            window.location.href = `{{ url('lab-tracking') }}?perPage=${perPage}`;
        }
    </script> --}}
@endsection







