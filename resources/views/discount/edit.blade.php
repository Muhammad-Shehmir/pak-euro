@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a href="{{ url('/discount') }}" class="text-muted fw-light">/ Discount</a><span class="color"> /</span><span class="text-heading fw-bold text-color"> Edit</span>
        </h4>
        <div class="row">
            <!-- FormValidation -->
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Add New</h5>
                    <div class="card-body">
                        <form method="POST" id="myForm" action="{{ url('/patient/add') }}" enctype="multipart/form-data"
                            id="formValidationExamples" class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="mdi mdi-account-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" required class="form-control name-validate"
                                            id="basic-icon-default-fullname" placeholder="Enter Discount Name" value="{{ $discount->discount_name }}" name="discount_name"
                                            aria-label="Enter Discount Name" aria-describedby="basic-icon-default-fullname2" />
                                        <label for="basic-icon-default-fullname">Discount Name</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-name" style="display: none;">
                                    <i class="mdi mdi-alert"></i>Discount Name is invalid
                                </span>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="start_date" type="date" id="basic-icon-default-phone"
                                            class="form-control" placeholder="YYYY-MM-DD" value="{{ $discount->start_date }}"
                                            aria-label="YYYY-MM-DD" aria-describedby="basic-icon-default-phone2" />
                                        <label for="basic-icon-default-phone">Start Date</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="end_date" type="date" id="basic-icon-default-phone"
                                            class="form-control" placeholder="YYYY-MM-DD" value="{{ $discount->end_date }}"
                                            aria-label="YYYY-MM-DD" aria-describedby="basic-icon-default-phone2" />
                                        <label for="basic-icon-default-phone">End Date</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label d-block">Discount Type</label>
                                <div class="form-check form-check-inline mb-2">
                                    <input type="radio" id="formValidationGender" name="discount_type"
                                    class="form-check-input" value="male" />
                                    <label class="form-check-label" for="formValidationdiscount_type">All</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="formValidationdiscount_type2" name="discount_type"
                                     class="form-check-input" value="female" />
                                    <label class="form-check-label" for="formValidationGender2">Selected</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="{{ url('/discount') }}" type="back" class="btn btn-label-secondary waves-effect">
                                    Back
                                </a>
                                <button type="submit" class="btn btn-primary submitBtn"  id="submitBtn" disabled
                                    >Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-datatable table-responsive pt-0 p-3">
                        <table class="datatables-basic table table-bordered">
                            <thead>
                                <tr>

                                    <th>
                                        <h6>Procedure Name</h6>
                                    </th>
                                    <th>
                                        <h6>Price</h6>
                                    </th>
                                    <th>
                                        <h6>Discounts</h6>
                                    </th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>

                                    <tr>
                                        <td>Root Canal Treatment</td>
                                        <td><input type="text" required class="form-control"
                                            name="name" value="16500"
                                            /></td>
                                        <td><input type="text" required class="form-control"
                                            name="name" value=""
                                            /></td>
                                    </tr>
                                    <tr>
                                        <td>Scaling & Polishing</td>
                                        <td><input type="text" required class="form-control"
                                            name="name" value="8500"
                                            /></td>
                                        <td><input type="text" required class="form-control"
                                            name="name" value=""
                                            /></td>
                                    </tr>
                                    <tr>
                                        <td>Consultation + OPG</td>
                                        <td><input type="text" required class="form-control"
                                            name="name" value="3500"
                                            /></td>
                                        <td><input type="text" required class="form-control"
                                            name="name" value=""
                                            /></td>
                                    </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /FormValidation -->
        </div>
    </div>


@endsection
