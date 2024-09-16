@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard /</a> <a
                href="{{ url('/client') }}" class="text-muted fw-light"> Client </a><span class="color">/</span><span
                class="text-heading fw-bold text-color"> Add </span>
        </h4>
        <div class="row">
            <!-- FormValidation -->
            <div class="col-12">
                <div class="card">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-header pb-0">Add New</h5>
                        {{-- <h5 class="card-header pb-0">Mr No. : {{ $last_patient->mr_number + 1 }}</h5> --}}
                    </div>
                    <div class="card-body">
                        <form method="POST" id="myForm" action="{{ url('/client/add') }}" enctype="multipart/form-data"
                            id="formValidationExamples" class="row g-3">
                            @csrf
                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline ">
                                    <div class="select2-primary">
                                        <select data-placeholder="Select Client Type" id="type_id" name="type_id" required
                                            class="select2 form-select-lg" data-allow-clear="true">
                                            <option value="">Select</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label for="client_type">Client Type</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="mdi mdi-account-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" required class="form-control name-validate"
                                            id="basic-icon-default-fullname" placeholder="Enter Name" name="name"
                                            aria-label="Enter Name" aria-describedby="basic-icon-default-fullname2" />
                                        <label for="basic-icon-default-fullname">Name</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-name" style="display: none;">
                                    <i class="mdi mdi-alert"></i> Name is invalid
                                </span>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="mdi mdi-account-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control name-validate"
                                            id="basic-icon-default-fullname" placeholder="Enter Father Name"
                                            name="father_name" aria-label="Enter Father Name"
                                            aria-describedby="basic-icon-default-fullname2" />
                                        <label for="basic-icon-default-fullname">Father Name</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-surname" style="display: none;">
                                    <i class="mdi mdi-alert"></i>Father Name is invalid
                                </span>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-phone"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input name="phone_no" type="text" id="basic-icon-default-phone"
                                            class="form-control phone-mask number-validate" placeholder="Enter Your Number"
                                            aria-label="Enter Phone No." aria-describedby="basic-icon-default-phone2" />
                                        <label for="basic-icon-default-phone">Phone No</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-number" style="display: none;">
                                    <i class="mdi mdi-alert"></i> Number is invalid
                                </span>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-whatsapp"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input name="whatsapp_no" type="text" id="basic-icon-default-phone"
                                            class="form-control phone-mask whtp-number-validate"
                                            placeholder="Enter Whatsapp No." aria-label="Enter Whatsapp No."
                                            aria-describedby="basic-icon-default-`2" />
                                        <label for="basic-icon-default-phone">Whatsapp No</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-whtp-number" style="display: none;">
                                    <i class="mdi mdi-alert"></i>Number is invalid
                                </span>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input name="dob" type="date" id="basic-icon-default-phone"
                                            class="form-control dob-validate" placeholder="YYYY-MM-DD"
                                            aria-label="YYYY-MM-DD" aria-describedby="basic-icon-default-phone2" />
                                        <label for="basic-icon-default-phone">Date Of Birth</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-dob" style="display: none;">
                                    <i class="mdi mdi-alert"></i> Date of birth cannot be in the future
                                </span>
                            </div> --}}
                            <div class="col-md-4">
                                <div class="input-group input-group-merge mb-2">
                                    <span class="input-group-text"><i class="mdi mdi-email-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="email" id="basic-icon-default-email"
                                            class="form-control email-validate" placeholder="Enter Email"
                                            aria-label="Enter Email" aria-describedby="basic-icon-default-email2" />
                                        <label for="basic-icon-default-email">Email</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-email" style="display: none;">
                                    <i class="mdi mdi-alert"></i>Email format is invalid
                                </span>
                            </div>
                            {{-- <div class="col-md-2">
                                <label class="form-label d-block">Gender</label>
                                <div class="form-check form-check-inline mb-2">
                                    <input type="radio" id="formValidationGender" name="gender"
                                        class="form-check-input" value="male" />
                                    <label class="form-check-label" for="formValidationGender">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="formValidationGender2" name="gender"
                                        class="form-check-input" value="female" />
                                    <label class="form-check-label" for="formValidationGender2">Female</label>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-2">
                                    <textarea class="form-control form-control-sm" name="address" rows="3" id="address"></textarea>
                                    <label for="address">Address</label>
                                </div>
                            </div>

                            {{-- <div class="col-md-4">
                                <div class="input-group input-group-merge mb-2">
                                    <span class="input-group-text"><i class="mdi mdi-home-city"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="state" id="basic-icon-default-email"
                                            class="form-control" placeholder="Enter State" aria-label="Enter State"
                                            aria-describedby="basic-icon-default-email2" />
                                        <label for="basic-icon-default-email">State</label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-3">
                                <div class="form-floating form-floating-outline ">
                                    <div class="select2-primary">
                                        <select data-placeholder="Select Country" id="country_id" name="country_id"
                                            class="select2 form-select-lg" data-allow-clear="true">
                                            <option value="">Select</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label for="country">Country</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating form-floating-outline ">
                                    <div class="select2-primary">
                                        <select data-placeholder="Select City" id="city_id" name="city_id"
                                            class="select2 w-full" data-allow-clear="true">
                                            <option value="">Select</option>
                                            {{-- @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    <label for="city">City</label>
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="input-group input-group-merge mb-2">
                                    <span class="input-group-text"><i class="mdi mdi-town-hall"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="country" id="basic-icon-default-email"
                                            class="form-control" placeholder="Enter Country" aria-label="Enter Country"
                                            aria-describedby="basic-icon-default-email2" />
                                        <label for="basic-icon-default-email">Country</label>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-4">
                                <div class="input-group input-group-merge mb-2">
                                    <span class="input-group-text"><i class="mdi mdi-numeric"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="zip_code" id="basic-icon-default-email"
                                            class="form-control" placeholder="Enter Zip Code" aria-label="Enter Zip Code"
                                            aria-describedby="basic-icon-default-email2" />
                                        <label for="basic-icon-default-email">Zip Code</label>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="col-12">
                                <a href="{{ url('/client') }}" type="back"
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#country_id').change(function() {
                var countryId = $(this).val();

                if (countryId) {
                    $.ajax({
                        url: '/api/get-cities/' + countryId,
                        type: 'GET',
                        success: function(data) {
                            var citiesDropdown = $('#city_id');
                            citiesDropdown.empty(); // Clear any existing options
                            citiesDropdown.append(
                            '<option value="">Select City</option>'); // Add default option

                            $.each(data.data, function(key, city) {
                                citiesDropdown.append('<option value="' + city.id +
                                    '">' + city.name + '</option>');
                            });
                        },
                        error: function() {
                            console.log('response', 'error');
                        }
                    });
                } else {
                    $('#city_id').empty(); // Clear the cities dropdown
                    $('#city_id').append('<option value="">Select City</option>'); // Add default option
                }
            });

        })
    </script>
@endsection
