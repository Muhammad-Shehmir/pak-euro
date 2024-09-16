@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a href="{{ url('/lab-of-tracking') }}" class="text-muted fw-light">/ Laboratory</a><span class="color"> /</span><span class="text-heading fw-bold text-color"> Edit</span>
        </h4>
        <div class="row">
            <!-- FormValidation -->
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Edit Laboratory</h5>
                    <div class="card-body">
                        <form method="POST" id="myform" action="{{ url('/lab-of-tracking/edit/' . $lab->id) }}"
                            enctype="multipart/form-data" id="formValidationExamples" class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="mdi mdi-account-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" required class="form-control name-validate" id="basic-icon-default-fullname"
                                            placeholder="Enter Name" name="name" value="{{ $lab->name }}"
                                            aria-label="Enter Name" aria-describedby="basic-icon-default-fullname2" />
                                        <label for="basic-icon-default-fullname"> Name</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-name" style="display: none;">
                                    <i class="mdi mdi-alert"></i> Name is invalid
                                </span>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-phone"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="phone_no" type="text" id="basic-icon-default-phone"
                                            class="form-control phone-mask number-validate" placeholder="Enter Phone No." value="{{ $lab->phone_no }}"
                                            aria-label="Enter Phone No." aria-describedby="basic-icon-default-phone2" />
                                        <label for="basic-icon-default-phone">Phone No</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-number" style="display: none;">
                                    <i class="mdi mdi-alert"></i> Number is invalid
                                </span>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-map-marker-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="address" type="text" id="basic-icon-default-phone" value="{{ $lab->address }}"
                                            class="form-control dob-picker" placeholder="Enter Your Address" aria-label="Enter Your Address"
                                            aria-describedby="basic-icon-default-phone2" />
                                        <label for="basic-icon-default-phone">Address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="{{ url('/lab-of-tracking') }}" type="back" class="btn btn-label-secondary waves-effect">
                                    Back
                                </a>
                                <button type="submit" class="btn btn-primary submitBtn" id="submitBtn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /FormValidation -->
        </div>
    </div>
@endsection
