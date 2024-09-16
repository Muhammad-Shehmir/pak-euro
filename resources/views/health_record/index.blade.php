 @extends('layout.master')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center p-3 py-0">
            <h4 class="fw-bold py-3 mb-2"><a href="{{ url('dashboard') }}" class="text-muted fw-light">Dashboard </a><span class="color">/ Health Record
            </h4></span>

        </div>


        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-header flex-column flex-md-row">

                <div class="head-label text-center">

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter"><span><i class="mdi mdi-plus me-sm-1"></i>
                        Add New
                    </button></span>
            </div>



                <div class="dt-action-buttons pt-3 pt-md-0">
                    <h4>Patient</h4>


                    <div class="dt-buttons btn-group flex-wrap">

                         <form method="GET" id="myForm" action="{{ url('/health-record') }}"
                            enctype="multipart/form-data" id="formValidationExamples" class="row g-3">
                            @csrf

                            <div class="form-floating form-floating-outline my-3">
                                <select required name="" type="text" class="select2 form-select form-select-lg"
                                    data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="Expenses">Expenses</option>
                                    <option value="In Expenses">In Expenses</option>

                                </select>

                            </div>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-search31"><i class="mdi mdi-magnify"></i></span>
                                <input
                                  type="text"
                                  class="form-control"
                                  placeholder="Search..."
                                  aria-label="Search..."
                                  aria-describedby="basic-addon-search31" />
                              </div>
                        </form>

                    </div>
                </div>
            </div>


        </div>

    </div>
@endsection








