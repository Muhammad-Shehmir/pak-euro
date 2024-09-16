@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a
                href="{{ url('/customers') }}" class="text-muted fw-light">/ Customer Arrival/Departure</a><span
                class="color"> /</span><span class="text-heading fw-bold text-color"> Edit</span>
        </h4>
        <div class="row">
            <!-- FormValidation -->
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Edit Arrival/Depaerture</h5>
                    <div class="card-body">
                        <form method="POST" id="myForm"
                            action="{{ url('/edit-arr-dep' . '/' . $customer->id . '/' . $customerarrivaldeparture->id) }}"
                            enctype="multipart/form-data" id="formValidationExamples" class="row g-3">
                            @csrf
                            <div class="row mt-4">



                                <div class="col-md-6 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select id="arrival_type" name="arrival_type"
                                            class="select2 form-select form-select-lg" data-allow-clear="true" disabled>
                                            <option value="">Please Select</option>
                                            <option value="1"
                                                {{ $customerarrivaldeparture->arrival_type == '1' ? 'selected' : '' }}>Self
                                                Arrival</option>
                                            <option value="2"
                                                {{ $customerarrivaldeparture->arrival_type == '2' ? 'selected' : '' }}>By
                                                Air</option>
                                            <option value="3"
                                                {{ $customerarrivaldeparture->arrival_type == '3' ? 'selected' : '' }}>By
                                                Boat</option>
                                        </select>
                                        <label for="self_arrival">Self Arrival</label>
                                    </div>
                                </div>


                                <div class="col-md-6 flight_no">
                                    <div class="input-group input-group-merge my-2">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="mdi mdi-airplane-plus"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input name="flight_no" type="text" id="basic-icon-default-phone"
                                                value="{{ $customerarrivaldeparture->flight_no }}"
                                                class="form-control phone-mask " placeholder="Enter Flight Number"
                                                aria-label="Enter Flight No" aria-describedby="basic-icon-default-phone2" />
                                            <label for="basic-icon-default-phone">Flight No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 departure_flight_no">
                                    <div class="input-group input-group-merge my-2">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="mdi mdi-airplane-plus"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input name="departure_flight_no" type="text" id="basic-icon-default-phone"
                                                value="{{ $customerarrivaldeparture->departure_flight_no }}"
                                                class="form-control phone-mask " placeholder="Enter Departure Flight No"
                                                aria-label="Enter Departure Flight No" aria-describedby="basic-icon-default-phone2" />
                                            <label for="basic-icon-default-phone">Departure Flight No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="mdi mdi-calendar"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input required name="arrival_time" type="date" id="basic-icon-default-phone"
                                                value="{{ \Carbon\Carbon::parse($customerarrivaldeparture->arrival_time)->format('Y-m-d') }}"
                                                class="form-control" placeholder="YYYY-MM-DD" aria-label="YYYY-MM-DD"
                                                aria-describedby="basic-icon-default-phone2" />
                                            <label for="basic-icon-default-phone">Arrival Date</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="mdi mdi-calendar"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input required name="departure_time" type="date"
                                                id="basic-icon-default-phone"
                                                value="{{ \Carbon\Carbon::parse($customerarrivaldeparture->departure_time)->format('Y-m-d') }}"
                                                class="form-control" placeholder="YYYY-MM-DD" aria-label="YYYY-MM-DD"
                                                aria-describedby="basic-icon-default-phone2" />
                                            <label for="basic-icon-default-phone">Departure Date</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6 boat_name">
                                    <div class="input-group input-group-merge my-2">
                                        <span class="input-group-text"><i class="mdi mdi-sail-boat"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" name="boat_name" id="basic-icon-default-email"
                                                value="{{ $customerarrivaldeparture->boat_name }}" class="form-control"
                                                placeholder="Enter Boat Name" aria-label="Enter Boat Name"
                                                aria-describedby="basic-icon-default-email2" />
                                            <label for="basic-icon-default-email">Boat Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-5">
                                    <a href="{{ url('/customers') }}" type="back"
                                        class="btn btn-label-secondary waves-effect">
                                        Back
                                    </a>
                                    <button type="submit" class="btn btn-primary submitBtn" id="submitBtn">Submit</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /FormValidation -->
        </div>
    </div>
@endsection

<script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script>
    function handleArrivalTypeChange(value) {
        if (value == 1) {
            $('.flight_no').hide();
            $('.boat_name').hide();
            $('.departure_flight_no').hide();
        } else if (value == 2) {
            $('.flight_no').show();
            $('.departure_flight_no').show();
            $('.boat_name').hide();
        } else if (value == 3) {
            $('.flight_no').hide();
            $('.departure_flight_no').hide();
            $('.boat_name').show();
        }
    }

    $(document).ready(function() {
        var arrival_type = '{{ $customerarrivaldeparture->arrival_type }}';
        console.log(arrival_type)
        // Call the function on page load with the initial value
        handleArrivalTypeChange(arrival_type);

        // Attach the function to the change event
        $('#arrival_type').change(function() {
            // Pass the new value when calling the function on change
            handleArrivalTypeChange($(this).val());
        });
    });
</script>
