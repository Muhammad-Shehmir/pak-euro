@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard /</a> <a
                href="{{ url('/treatment-plans') }}" class="text-muted fw-light"> Treatment Plans </a><span
                class="color">/</span><span class="text-heading fw-bold text-color"> Edit </span>
        </h4>
        <div class="row">
            <!-- FormValidation -->
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Edit</h5>
                    <div class="card-body">
                        <form method="POST" id="myForm" action="{{ url('/treatment-plan/edit/' . $treatment_plan->id) }}"
                            enctype="multipart/form-data" id="formValidationExamples" class="row g-3">
                            @csrf
                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline mb-2">
                                    <select id="patient_id" required name="patient_id" type="text"
                                        oninput="getPatientId()" class="select2 form-select form-select-lg"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($patients as $patient)
                                            <option {{ $patient->id == $treatment_plan->patient_id ? 'selected' : '' }}
                                                value="{{ $patient->id }}">{{ $patient->name }} - {{ $patient->id }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="patients">Patient</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-whatsapp"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="whatsapp_no" type="text" id="whatsapp_no"
                                            class="form-control phone-mask whtp-number-validate"
                                            value="{{ $treatment_plan->patient->name }}" placeholder="Enter Whatsapp No."
                                            aria-label="Enter Whatsapp No." aria-describedby="basic-icon-default-`2" />
                                        <label for="whatsapp_no">Whatsapp No</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-whtp-number" style="display: none;">
                                    <i class="mdi mdi-alert"></i>Number is invalid
                                </span>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="start_date" type="date" id="basic-icon-default-phone"
                                            class="form-control " placeholder="YYYY-MM-DD" aria-label="YYYY-MM-DD"
                                            value="{{ $treatment_plan->start_date }}"
                                            aria-describedby="basic-icon-default-phone2" />
                                        <label for="basic-icon-default-phone">Start Date</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-2">
                                    <select multiple id="procedure_id" required name="procedure_ids[]" type="text"
                                        oninput="getProcedureId()" class="select2 form-select form-select-lg"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($procedures as $procedure)
                                            <option
                                                {{ in_array($procedure->id, explode(',', $treatment_plan->procedure_ids)) ? 'selected' : '' }}
                                                value="{{ $procedure->id }}">{{ $procedure->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="procedures">Procedures</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span class="input-group-text"><i class="mdi mdi-cash-multiple"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" class="form-control" id="charges" name="charges" required
                                            placeholder="Enter Charges" value="{{ $treatment_plan->total_amount }}" />
                                        <label for="charges">Charges</label>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="input-group input-group-merge mb-2">
                                    <span class="input-group-text"><i class="mdi mdi-percent-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" class="form-control" id="discount" name="discount"
                                            placeholder="Enter Discount %" value="{{ $treatment_plan->discount }}" />
                                        <label for="discount">Discount</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-merge mb-2">
                                    <span class="input-group-text"><i class="mdi mdi-percent-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" class="form-control" id="tax" name="tax"
                                            placeholder="Enter Tax %" value="{{ $treatment_plan->vat }}" />
                                        <label for="tax">Tax</label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-4">
                                <div class="input-group input-group-merge mb-2">
                                    <span class="input-group-text"><i class="mdi mdi-cash-multiple"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" class="form-control" id="amount" name="amount"
                                            required placeholder="Enter Amount"
                                            value="{{ $treatment_plan->grand_total }}" />
                                        <label for="amount">Total Amount</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-merge mb-2">
                                    <div class="form-floating form-floating-outline">
                                        <select required name="status" type="text"
                                            class="select2 form-select form-select-lg" class="form-control">
                                            <option {{ $treatment_plan->status == 1 ? 'selected' : '' }} value="1">
                                                Given</option>
                                            <option {{ $treatment_plan->status == 2 ? 'selected' : '' }} value="2">In
                                                Process</option>
                                            <option {{ $treatment_plan->status == 3 ? 'selected' : '' }} value="3">
                                                Done</option>
                                            <option {{ $treatment_plan->status == 4 ? 'selected' : '' }} value="4">
                                                Cancelled</option>
                                        </select>
                                        <label for="status">Status</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline mb-2">
                                    <textarea class="form-control" name="description" rows="5" id="description">{{ $treatment_plan->description }}</textarea>
                                    <label for="description">Description</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="{{ url('/treatment-plans') }}" type="back"
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


    <script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Select the input fields and the result field
            var $charges = $("#charges");
            var $discount = $("#discount");
            var $tax = $("#tax");
            var $share = $("#share");
            var $amount = $("#amount");

            // Listen for changes in the input fields
            $charges.on("input", calculateTotalAmount);
            $discount.on("input", calculateTotalAmount);
            $tax.on("input", calculateTotalAmount);
            $share.on("input", calculateTotalAmount);

            // Function to calculate the total amount
            function calculateTotalAmount() {
                // Parse values and ensure they are numeric
                var charges = parseFloat($charges.val()) || 0;
                var discountPercentage = parseFloat($discount.val()) || 0;
                var taxPercentage = parseFloat($tax.val()) || 0;
                var sharePercentage = parseFloat($share.val()) || 0;

                // Calculate amounts
                var discountAmount = (discountPercentage / 100) * charges;
                var taxAmount = (taxPercentage / 100) * charges;
                var shareAmount = (sharePercentage / 100) * charges;

                // Calculate total amount
                var amount = charges - discountAmount + taxAmount - shareAmount;

                // Update the total amount field
                $amount.val(amount.toFixed(2)); // Display with 2 decimal places
            }
        });

        function getProcedureId() {
            var select = document.getElementById("procedure_id");
            var selectedOptions = select.selectedOptions;

            // Initialize variables to store the total charges and total amounts
            var totalCharges = 0;
            var totalAmount = 0;

            // Iterate through selected options
            for (var i = 0; i < selectedOptions.length; i++) {
                var selectedProcedure = selectedOptions[i].value;

                // Make an Ajax request for each selected procedure
                $.ajax({
                    type: "POST",
                    data: {
                        "procedure_id": selectedProcedure,
                    },
                    url: "{{ url('api/procedure/getById') }}",
                    dataType: 'json',
                    async: false, // Wait for each request to complete
                    success: function(result) {
                        var data = result.data;
                        var charges = parseFloat(data.price) || 0;

                        // Accumulate charges and amounts
                        totalCharges += charges;
                        totalAmount += charges;
                    }
                });
            }

            // Update the input fields with the accumulated values
            var chargesInput = document.getElementById("charges");
            var amountInput = document.getElementById("amount");

            chargesInput.value = totalCharges.toFixed(2);
            amountInput.value = totalAmount.toFixed(2);
        }

        function getPatientId() {
            var select = document.getElementById("patient_id");
            var selectedPatient = select.options[select.selectedIndex].value;

            $.ajax({
                type: "POST",
                data: {
                    "patient_id": selectedPatient,
                },
                url: "{{ url('api/patient/getById') }}",
                dataType: 'json',
                success: function(result) {
                    var data = result.data;
                    document.getElementById("whatsapp_no").value = data.whatsapp_no;
                }
            })
        };
    </script>
    <script>
        // Function to update the file label and show the remove button
        function updateFileLabelAndButton(filename) {
            $(".custom-file-label").html(filename);
            $("#remove-profile-pic").show();
            $(".image-preview").show();
            $(".image-preview-box").show();
        }

        // Function to reset the file input and hide the remove button
        function resetFileInput() {
            $(".custom-file-label").html("Choose a file");
            $("#remove-profile-pic").hide();
            $(".image-preview").hide();
            $(".image-preview-box").hide();
            $("#profile-pic-input").val("");
            $("#profile-pic-preview").hide().attr("src", "");
        }

        // Handle file input change event
        $("#profile-pic-input").change(function() {
            const fileInput = this;
            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $("#profile-pic-preview").attr("src", e.target.result).show();
                    updateFileLabelAndButton(fileInput.files[0].name);
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        });

        // Handle remove button click event
        $("#remove-profile-pic").click(function() {
            resetFileInput();
        });
        // With this code, the file input is styled like a button with a label.When a user selects a file,
        //     it updates the label and shows a "Remove"
        // button.If the user clicks "Remove,"
        // the file input is reset.The selected image is also displayed with the option to remove it.This example uses jQuery,
        //     but you can adapt it to plain JavaScript
        // if needed.
    </script>
@endsection
