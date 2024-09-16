@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard /</a><a href="{{ url('/doctor') }}" class="text-heading fw-bold"> Doctor</a>
        </h4>
        <div class="row">
            <!-- FormValidation -->
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Edit Doctor</h5>
                    <div class="card-body">
                        <form method="POST" id="myForm" action="{{ url('/doctor/edit/' . $doctor->id) }}"
                            enctype="multipart/form-data" id="formValidationExamples" class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="mdi mdi-account-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" required class="form-control name-validate" id="basic-icon-default-fullname"
                                            placeholder="Enter Name" name="name" value="{{ $doctor->name }}"
                                            aria-label="Enter Name" aria-describedby="basic-icon-default-fullname2" />
                                        <label for="basic-icon-default-fullname">Doctor Name</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-name" style="display: none;">
                                    <i class="mdi mdi-alert"></i> Name is invalid
                                </span>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="mdi mdi-format-list-bulleted-type"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" required class="form-control" id="basic-icon-default-fullname"
                                            placeholder="Enter Your type" name="type" value="{{ $doctor->type }}" aria-label="Enter Your Type"
                                            aria-describedby="basic-icon-default-fullname2" />
                                        <label for="basic-icon-default-fullname">Type</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span class="input-group-text"><i class="mdi mdi-email-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="email" id="basic-icon-default-email"
                                            class="form-control email-validate" placeholder="Enter Email" value="{{ $doctor->email }}"
                                            aria-label="Enter Email" aria-describedby="basic-icon-default-email2" />
                                        <label for="basic-icon-default-email">Email</label>
                                    </div>
                                    {{-- <span id="basic-icon-default-email2" class="input-group-text">@gmail.com</span> --}}
                                </div>
                                <span class="text-danger validation-email" style="display: none;">
                                    <i class="mdi mdi-alert"></i>Email format is invalid
                                </span>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-phone"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="phone_no" type="text" id="basic-icon-default-phone"
                                            class="form-control phone-mask number-validate" placeholder="Enter Phone No." value="{{ $doctor->phone_no }}"
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
                                            class="mdi mdi-whatsapp"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="whatsapp_no" type="text" id="basic-icon-default-phone"
                                            class="form-control phone-mask whtp-number-validate" placeholder="Enter Whatsapp No." value="{{ $doctor->whatsapp_no }}"
                                            aria-label="Enter Whatsapp No." aria-describedby="basic-icon-default-`2" />
                                        <label for="basic-icon-default-phone">Whatsapp No</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-whtp-number" style="display: none;">
                                    <i class="mdi mdi-alert"></i>Number is invalid
                                </span>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-numeric"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="cnic" type="text" id="basic-icon-default-phone" value="{{ $doctor->cnic }}"
                                            class="form-control" data-inputmask='"mask": "99999-9999999-9"' aria-label="Enter Cnic" placeholder="xxxxx-xxxxxxx-x"
                                            aria-describedby="basic-icon-default-phone2" />
                                        <label for="basic-icon-default-phone">CNIC</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-map-marker-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="address" type="text" id="basic-icon-default-phone" value="{{ $doctor->address }}"
                                            class="form-control dob-picker" placeholder="Enter Your Address" aria-label="Enter Your Address"
                                            aria-describedby="basic-icon-default-phone2" />
                                        <label for="basic-icon-default-phone">Address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <select class="form-select" id="basic-default-country" required>
                                  <option value="category_id" value="{{ $doctor->category_id }}">Visiting Faculty</option>
                                  <option value="category_id" value="{{ $doctor->category_id }}">Employee</option>

                                </select>
                                <label for="basic-default-country">Category ID</label>
                              </div>
                            <div class="col-12">
                                <a href="{{ url('/doctor') }}" type="back" class="btn btn-label-secondary waves-effect">
                                    Back
                                </a>
                                <button type="submit" class="btn btn-primary submitBtn" id="submitBtn" >Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /FormValidation -->
        </div>
    </div>
@endsection
