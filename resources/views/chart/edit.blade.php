@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a href="{{ url('/chart-of-account') }}" class="text-muted fw-light">/ Chart Of Account</a><span class="color"> /</span><span class="text-heading fw-bold text-color"> Edit</span>
        </h4>
        <div class="row">
            <!-- FormValidation -->
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Edit Chart Of Account</h5>
                    <div class="card-body">
                        <form method="POST" id="myForm" action="{{ url('/chart-of-account/edit/' . $chart->id) }}"
                            enctype="multipart/form-data" id="formValidationExamples" class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="mdi mdi-account-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" required class="form-control name-validate"
                                            value="{{ $chart->name }}" id="basic-icon-default-fullname"
                                            placeholder="Enter Name" name="name" aria-label="Enter Name"
                                            aria-describedby="basic-icon-default-fullname2" />
                                        <label for="basic-icon-default-fullname"> Name</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-name" style="display: none;">
                                    <i class="mdi mdi-alert"></i> Name is invalid
                                </span>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span class="input-group-text"><i class="mdi mdi-email-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="email" id="basic-icon-default-email"
                                            value="{{ $chart->email }}" class="form-control email-validate"
                                            placeholder="Enter Email" aria-label="Enter Email"
                                            aria-describedby="basic-icon-default-email2" />
                                        <label for="basic-icon-default-email">Email</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-email" style="display: none;">
                                    <i class="mdi mdi-alert"></i>Email format is invalid
                                </span>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-address" class="input-group-text"><i
                                            class="mdi mdi-map-marker-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="address" type="text" id="basic-icon-default-address"
                                            class="form-control dob-picker" placeholder="Enter Your Address"
                                            value="{{ $chart->address }}" aria-label="Enter Your Address"
                                            aria-describedby="basic-icon-default-address" />
                                        <label for="basic-icon-default-address">Address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-phone"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="mobile_no" type="text" id="basic-icon-default-phone"
                                            value="{{ $chart->mobile_no }}" class="form-control phone-mask number-validate"
                                            placeholder="Enter Your Number" aria-label="Enter Phone No."
                                            aria-describedby="basic-icon-default-phone2" />
                                        <label for="basic-icon-default-phone">Mobile No</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-number" style="display: none;">
                                    <i class="mdi mdi-alert"></i> Number is invalid
                                </span>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-numeric"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="cnic" type="text" id="basic-icon-default-phone"
                                            placeholder="xxxxx-xxxxxxx-x" class="form-control" value="{{ $chart->cnic }}"
                                            data-inputmask='"mask": "99999-9999999-9"' aria-label="Enter Cnic Number"
                                            aria-describedby="basic-icon-default-phone2" />
                                        <label for="basic-icon-default-phone">Cnic</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select name="category_id" type="text" class="select2 form-select form-select-lg" data-allow-clear="true">
                                        <option value="">Select</option>
                                        <option value="1" @if ($chart->category_id == 1) selected @endif>category 1</option>
                                        <option value="2" @if ($chart->category_id == 2) selected @endif>category 2</option>
                                        <option value="3" @if ($chart->category_id == 3) selected @endif>category 3</option>
                                        <option value="4" @if ($chart->category_id == 4) selected @endif>category 4</option>
                                    </select>
                                    <label for="category_id">Category</label>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select name="account_type_id" type="text" class="select2 form-select form-select-lg"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($account_type as $item)
                                            <option {{ $chart->account_type_id == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="account_type_id">Account Type</label>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select name="class_id" type="text" class="select2 form-select form-select-lg" data-allow-clear="true">
                                        <option value="">Select</option>
                                        <option value="1" @if ($chart->class_id == 1) selected @endif>class 1</option>
                                        <option value="2" @if ($chart->class_id == 2) selected @endif>class 2</option>
                                        <option value="3" @if ($chart->class_id == 3) selected @endif>class 3</option>
                                        <option value="4" @if ($chart->class_id == 4) selected @endif>class 4</option>
                                    </select>
                                    <label for="class_id">Class</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-address" class="input-group-text"><i
                                            class=""></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="credit_limit" type="text"
                                            id="basic-icon-default-address" class="form-control"
                                            placeholder="Enter Credit Limits" value="{{ $chart->credit_limit }}"
                                            aria-label="Enter Credit Limits"
                                            aria-describedby="basic-icon-default-address" />
                                        <label for="basic-icon-default-address">Credit Limits</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-address" class="input-group-text"><i
                                            class=""></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="credit_days" type="text" id="basic-icon-default-address"
                                            class="form-control" placeholder="Enter Credit Days"
                                            value="{{ $chart->credit_days }}" aria-label="Enter Credit Days"
                                            aria-describedby="basic-icon-default-address" />
                                        <label for="basic-icon-default-address">Credit Days</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-address" class="input-group-text"><i
                                            class=""></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="debit" type="text" id="basic-icon-default-address"
                                            class="form-control" placeholder="Enter Debit" value="{{ $chart->debit }}"
                                            aria-label="Enter Debit" aria-describedby="basic-icon-default-address" />
                                        <label for="basic-icon-default-address">Debit</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-address" class="input-group-text"><i
                                            class=""></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input  name="ntn_no" type="number" id="basic-icon-default-address"
                                            class="form-control" placeholder="Enter NTN No."
                                            value="{{ $chart->ntn_no }}" aria-label="Enter NTN No."
                                            aria-describedby="basic-icon-default-address" />
                                        <label for="basic-icon-default-address">NTN No.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-address" class="input-group-text"><i
                                            class=""></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input  name="gst_no" type="number" id="basic-icon-default-address"
                                            class="form-control" placeholder="Enter GST No."
                                            value="{{ $chart->gst_no }}" aria-label="Enter GST No."
                                            aria-describedby="basic-icon-default-address" />
                                        <label for="basic-icon-default-address">GST No.</label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <a href="{{ url('/chart-of-account') }}" type="back" class="btn btn-label-secondary waves-effect">
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
