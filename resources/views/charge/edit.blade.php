@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a
                href="{{ url('/charges') }}" class="text-muted fw-light">/ Charges</a><span class="color"> /</span><span
                class="text-heading fw-bold text-color"> Edit</span>
        </h4>
        <div class="row">
            <!-- FormValidation -->
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">Edit Charges</h5>
                    <div class="card-body">
                        <form method="POST" id="myForm" action="{{ url('charges/edit/' . $charge->id) }}"
                            enctype="multipart/form-data" id="formValidationExamples" class="row g-3">
                            @csrf
                           
                            <div class="col-md-4">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="mdi mdi-account-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" required class="form-control" id="basic-icon-default-fullname"
                                            placeholder="Enter Name" name="name" value="{{ $charge->name }}"
                                            aria-label="Enter Name" aria-describedby="basic-icon-default-fullname2" />
                                        <label for="basic-icon-default-fullname"> Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-merge mb-2">
                                    <span class="input-group-text"><i class="mdi mdi-cash-multiple"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="price" id="basic-icon-default-email"
                                            class="form-control number-validate" placeholder="Enter Email"
                                            value="{{ $charge->price }}" aria-label="Enter Price"
                                            aria-describedby="basic-icon-default-email2" />
                                        <label for="basic-icon-default-price">Price</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-number" style="display: none;">
                                    <i class="mdi mdi-alert"></i> Number is invalid
                                </span>
                            </div>
                            <div class="col-12">
                                <a href="{{ url('/charges') }}" type="back"
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
