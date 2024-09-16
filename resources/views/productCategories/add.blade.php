@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a
                href="{{ url('/product-categories') }}" class="text-muted fw-light">/ Procedure</a><span class="color">
                /</span><span class="text-heading fw-bold text-color"> Add</span>
        </h4>
        <div class="row">
            <!-- FormValidation -->
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Add New</h5>
                    <div class="card-body">
                        <form method="POST" id="myForm" action="{{ url('/product-category/add') }}"
                            enctype="multipart/form-data" id="formValidationExamples" class="row g-3">
                            @csrf
                            <div class="col-md-12">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="mdi mdi-account-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" required class="form-control name-validate"
                                            id="basic-icon-default-fullname" placeholder="Enter Name" name="name"
                                            aria-label="Enter Name" aria-describedby="basic-icon-default-fullname2" />
                                        <label for="basic-icon-default-fullname"> Name</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-name" style="display: none;">
                                    <i class="mdi mdi-alert"></i> Name is invalid
                                </span>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-warehouse"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="department" type="text" id="basic-icon-default-phone"
                                            class="form-control phone-mask" placeholder="Enter Department"
                                            aria-label="Enter department" aria-describedby="basic-icon-default-phone2" />
                                        <label for="basic-icon-default-department">Department</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <div class="form-floating form-floating-outline">
                                        <select id="doctor" required name="doctor_id" type="text"
                                            class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value="">Select</option>
                                            @foreach ($doctors as $doctor)
                                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="doctors">Doctors</label>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-percent-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="share" type="text" id="basic-icon-default-phone"
                                            class="form-control dob-picker" placeholder="Enter Your Share"
                                            aria-label="Enter Your Share" aria-describedby="basic-icon-default-phone2" />
                                        <label for="basic-icon-default-phone">Share</label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <a href="{{ url('/product-categories') }}" type="back"
                                    class="btn btn-label-secondary waves-effect">
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
