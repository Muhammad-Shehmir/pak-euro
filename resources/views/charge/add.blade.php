@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a
                href="{{ url('/charges') }}" class="text-muted fw-light">/ Charges</a><span class="color"> /</span><span
                class="text-heading fw-bold text-color"> Add</span>
        </h4>
        <div class="row">
            <!-- FormValidation -->
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">Add New</h5>
                    <div class="card-body">
                        <form method="POST" id="myForm" action="{{ route('charges.store') }}" enctype="multipart/form-data"
                            id="formValidationExamples" class="row g-3">
                            @csrf
                            {{-- <div class="col-md-4">
                                <div class="form-floating form-floating-outline ">
                                    <div class="select2-primary">
                                        <select id="product_category_id" required name="product_category_id" type="text"
                                            class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value="">Select</option>
                                            @foreach ($product_categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label for="patients">Product Categories</label>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="mdi mdi-account-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" required class="form-control" id="basic-icon-default-fullname"
                                            placeholder="Enter Name" name="name" aria-label="Enter Name"
                                            aria-describedby="basic-icon-default-fullname2" />
                                        <label for="basic-icon-default-fullname"> Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span class="input-group-text"><i class="mdi mdi-cash-multiple"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="price" id="basic-icon-default-email" required
                                            class="form-control number-validate" placeholder="Enter Price"
                                            aria-label="Enter Price" aria-describedby="basic-icon-default-email2" />
                                        <label for="basic-icon-default-price">Price</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-number" style="display: none;">
                                    <i class="mdi mdi-alert"></i> Number is invalid
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
