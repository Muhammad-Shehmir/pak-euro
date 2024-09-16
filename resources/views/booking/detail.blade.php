@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-2 mb-1"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard / </a><a
                href="{{ url('/appointment') }}" class="text-muted fw-light">Appointments </a><span class="color">/
                Appointment Detail</span>
        </h4>
        <div class="row">
            <div class="col-12 mb-4">
                <div class="bs-stepper wizard-vertical vertical wizard-vertical-icons-example wizard-vertical-icons mt-2">
                    <div class="bs-stepper-header gap-lg-2">
                        <div class="step" data-target="#account-details-1">
                            <button type="button" class="step-trigger">
                                <span class="avatar">
                                    <span class="avatar-initial rounded-2">
                                        <i class="mdi mdi-clock-plus-outline mdi-24px"></i>
                                    </span>
                                </span>
                                <span class="bs-stepper-label flex-column align-items-start gap-1 ms-2">
                                    <span class="bs-stepper-title">Appointment Details</span>
                                    {{-- <span class="bs-stepper-subtitle">Setup Account Details</span> --}}
                                </span>
                            </button>
                        </div>
                        <div class="step" data-target="#appointment-images">
                            <button type="button" class="step-trigger">
                                <span class="avatar">
                                    <span class="avatar-initial rounded-2">
                                        <i class="mdi mdi-image-plus-outline mdi-24px"></i>
                                    </span>
                                </span>
                                <span class="bs-stepper-label flex-column align-items-start gap-1 ms-2">
                                    <span class="bs-stepper-title">Images</span>
                                </span>
                            </button>
                        </div>
                        <div class="step" data-target="#personal-info-1">
                            <button type="button" class="step-trigger">
                                <span class="avatar">
                                    <span class="avatar-initial rounded-2">
                                        <i class="mdi mdi-account-clock-outline mdi-24px"></i>
                                    </span>
                                </span>
                                <span class="bs-stepper-label flex-column align-items-start gap-1 ms-2">
                                    <span class="bs-stepper-title">History</span>
                                    {{-- <span class="bs-stepper-subtitle">Add personal info</span> --}}
                                </span>
                            </button>
                        </div>
                        <div class="step" data-target="#social-links-1">
                            <button type="button" class="step-trigger">
                                <span class="avatar">
                                    <span class="avatar-initial rounded-2">
                                        <i class="mdi mdi-cash-clock mdi-24px"></i>
                                    </span>
                                </span>
                                <span class="bs-stepper-label flex-column align-items-start gap-1 ms-2">
                                    <span class="bs-stepper-title">Payments</span>
                                    {{-- <span class="bs-stepper-subtitle">Add social links</span> --}}
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <!-- Account Details -->
                        <div id="account-details-1" class="content">
                            {{-- <div class="content-header mb-3">
                                    <h6 class="mb-0">Appointment Details</h6>
                                    <small>Enter Your Account Details.</small>
                                </div> --}}
                            <div class="row">
                                <input type="hidden" class="form-control" id="appointment_id" name="appointment_id"
                                    value="{{ $appointment->id }}" />
                                <div class="col-md-4">
                                    <div class="input-group input-group-merge my-2 disabled">
                                        <span id="dateTime" class="input-group-text"><i
                                                class="mdi mdi-calendar"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="appointment_date"
                                                value="{{ $appointment->appointment_at }}" disabled name="appointment_date"
                                                required placeholder="Appointment Date" />
                                            <label for="appointment_date">Appointment Date & Time</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-merge my-2 disabled">
                                        <span id="day" class="input-group-text"><i
                                                class="mdi mdi-calendar"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="appointment_day"
                                                value="{{ $appointment->day->name }}" disabled name="appointment_day"
                                                required placeholder="Appointment Day" />
                                            <input type="hidden" class="form-control" id="day_id" name="day_id" />
                                            <label for="appointment_day">Appointment Day</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline my-2">
                                        <select id="doctor_id" required name="doctor_id" type="text" disabled
                                            class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value="">Select</option>
                                            @foreach ($doctors as $doctor)
                                                <option {{ @$appointment->doctor_id == $doctor->id ? 'selected' : '' }}
                                                    value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="doctors">Doctors</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline my-2">
                                        <select id="patient_id" required name="patient_id" type="text" disabled
                                            class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value="">Select</option>
                                            @foreach ($patients as $patient)
                                                <option {{ @$appointment->patient_id == $patient->id ? 'selected' : '' }}
                                                    value="{{ $patient->id }}">{{ $patient->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="patients">Patient</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline my-2">
                                        <select id="procedure_id" required name="procedure_id" type="text"
                                            oninput="getProcedureId()" class="select2 form-select form-select-lg" disabled
                                            data-allow-clear="true">
                                            <option value="">Select</option>
                                            @foreach ($procedures as $procedure)
                                                <option
                                                    {{ @$appointment->procedure_id == $procedure->id ? 'selected' : '' }}
                                                    value="{{ $procedure->id }}">{{ $procedure->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="procedures">Procedures</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-merge my-2 disabled">
                                        <span class="input-group-text"><i class="mdi mdi-cash-multiple"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="charges" name="charges"
                                                value="{{ $appointment->charges }}" disabled required
                                                placeholder="Enter Charges" />
                                            <label for="charges">Charges</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-merge my-2 disabled">
                                        <span class="input-group-text"><i class="mdi mdi-percent-outline"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="discount"
                                                value="{{ $appointment->discount }}" disabled name="discount"
                                                placeholder="Enter Discount %" />
                                            <label for="discount">Discount</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-merge my-2 disabled">
                                        <span class="input-group-text"><i class="mdi mdi-percent-outline"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="tax" name="tax"
                                                value="{{ $appointment->tax }}" disabled placeholder="Enter Tax %" />
                                            <label for="tax">Tax</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2 disabled">
                                        <span class="input-group-text"><i class="mdi mdi-percent-outline"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="share" name="share"
                                                value="{{ $appointment->share }}" disabled placeholder="Enter Share %" />
                                            <label for="share">Share (Optional)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2 disabled">
                                        <span class="input-group-text"><i class="mdi mdi-cash-multiple"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="amount" name="amount"
                                                value="{{ $appointment->total_amount }}" disabled required
                                                placeholder="Enter Amount" />
                                            <label for="amount">Amount</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating form-floating-outline my-2">
                                        <textarea class="form-control" name="comment" id="comment" disabled>{{ $appointment->comment }}</textarea>
                                        <label for="comment">Comment</label>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button class="btn btn-outline-secondary btn-prev" disabled>
                                        <i class="mdi mdi-arrow-left me-sm-1 me-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <button class="btn btn-primary btn-next">
                                        <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                        <i class="mdi mdi-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="appointment-images" class="content">
                            <div class="row">
                                <form action="{{ url('/appointment-images/save/' . $appointment->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end mb-2">
                                            <button type="submit" class="btn btn-primary submitBtn">Save</button>
                                        </div>
                                        <input type="hidden" class="form-control" id="appointment_id"
                                            name="appointment_id" value="{{ $appointment->id }}" />
                                        <div class="col-md-12">
                                            <div class="input-group input-group-merge mb-2">
                                                <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                        class="mdi mdi-image-outline"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <div class="custom-file-upload">
                                                        <label for="profile-pic-input" class="custom-file-label">Choose
                                                            files</label>
                                                        <input type="file" name="appointment_images[]"
                                                            class="profile-pic-input" id="profile-pic-input"
                                                            accept=".png, .jpeg, .jpg, .pdf, .svg" multiple />
                                                        <input type="hidden" id="profile-pic-hidden"
                                                            name="appointment_images_hidden[]" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <label id="current_files" style="display: none" for="current_files">Current Files:</label>
                                            <div class="image-preview-box" id="image-preview-box">
                                            </div>
                                            @if ($appointment_images)
                                                <label for="uploaded_files">Uploaded Files:</label>
                                                <div class="image-preview-box" style="display:flex; height:145px;">
                                                    @foreach ($appointment_images as $image)
                                                        <div class="image-preview">
                                                            <button class="remove-button-multiple"
                                                                data-image-id="{{ $image->id }}">x</button>
                                                            <img class="profile-pic-preview"
                                                                src="{{ url('uploads/appointment_images/' . $image->file_name) }}"
                                                                alt="Profile Pic" />
                                                        </div>
                                                    @endforeach
                                                    <input type="hidden" id="image-ids-input" name="image_ids"
                                                        value="">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                                <div class="col-12 d-flex justify-content-between">
                                    <button class="btn btn-outline-secondary btn-prev">
                                        <i class="mdi mdi-arrow-left me-sm-1 me-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <button class="btn btn-primary btn-next">
                                        <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                        <i class="mdi mdi-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Personal Info -->
                        <div id="personal-info-1" class="content">
                            {{-- <div class="content-header mb-3">
                                <h6 class="mb-0">Personal Info</h6>
                                    <small>Enter Your Personal Info.</small>
                            </div> --}}
                            <form method="POST" id="appointmentStatusForm">
                                @csrf
                                <div class="row border-bottom pb-4">
                                    <div class="col-md-3">
                                        <div class="input-group input-group-merge my-2 ">
                                            <span id="dateTime" class="input-group-text"><i
                                                    class="mdi mdi-calendar"></i></span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="hidden" class="form-control" id="appointment_id"
                                                    value="{{ $appointment->id }}" name="appointment_id" />
                                                <input type="text" class="form-control" id="visit_no"
                                                    name="visit_no" required placeholder="Visit No." />
                                                <label for="visit_no">Visit No.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-merge my-2 ">
                                            <span id="day" class="input-group-text"><i
                                                    class="mdi mdi-calendar"></i></span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="date" class="form-control" id="next_follow_up"
                                                    name="next_follow_up" required placeholder="Next Follow Up Date" />
                                                <label for="next_follow_up">Next Follow Up Date</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating form-floating-outline my-2">
                                            <select id="appointment_status" required name="appointment_status"
                                                type="text" class="select2 form-select form-select-lg"
                                                data-allow-clear="true">
                                                <option value="">Select</option>
                                                @foreach ($appointment_status_master as $status)
                                                    <option {{ $appointment->status == $status->id ? 'selected' : '' }}
                                                        value="{{ $status->id }}">{{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="status">Status</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating form-floating-outline my-2">
                                            <textarea class="form-control form-control-sm" name="comment" rows="2" id="comment"></textarea>
                                            <label for="comment">Comment</label>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end mt-2">
                                        <button type="submit" class="btn btn-primary submitBtn">
                                            <span class="align-middle d-sm-inline-block d-none me-sm-1">Save</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="card-datatable table-responsive pt-5 w-100">
                                <table class="datatables-basic table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                <h6>Visit No.</h6>
                                            </th>
                                            <th>
                                                <h6>Payment</h6>
                                            </th>
                                            <th>
                                                <h6>Remaining Amount</h6>
                                            </th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->visit_no }}</td>
                                                <td>{{ $payment->amount_paid }}</td>
                                                <td>{{ $payment->amount_remaining }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-outline-secondary btn-prev">
                                    <i class="mdi mdi-arrow-left me-sm-1 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <button class="btn btn-primary btn-next">
                                    <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                    <i class="mdi mdi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                        <!-- Social Links -->
                        <div id="social-links-1" class="content">
                            {{-- <div class="content-header mb-3">
                                <h6 class="mb-0">Social Links</h6>
                                <small>Enter Your Social Links.</small>
                            </div> --}}
                            <form method="POST" action="{{ url('appointment-payment/save/' . $appointment->id) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row pb-4">
                                            <div class="col-md-6">
                                                <div class="form-floating form-floating-outline my-2">
                                                    <select id="visit_no_dropdown" required name="visit_no"
                                                        type="text" class="select2 form-select form-select-lg"
                                                        data-allow-clear="true">
                                                        <option value="">Select</option>
                                                        @foreach ($appointment_status as $status)
                                                            <option value="{{ $status->visit_no }}">
                                                                {{ $status->visit_no }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="visit_no">Visit No.</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group input-group-merge my-2 ">
                                                    <span id="dateTime" class="input-group-text"><i
                                                            class="mdi mdi-cash-fast"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" id="amount_paid"
                                                            name="amount_paid" required placeholder="Payment" />
                                                        <label for="amount_paid">Payment</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group input-group-merge my-2">
                                                    <span id="dateTime" class="input-group-text"><i
                                                            class="mdi mdi-cash-multiple"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" id="amount_remaining"
                                                            name="amount_remaining" readonly
                                                            placeholder="Amount Remaining"
                                                            value="{{ $remaining_amount ? number_format($remaining_amount->amount_remaining, 2) : number_format($appointment->total_amount, 2) }}" />
                                                        <label for="amount_remaining">Amount Remaining</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group input-group-merge my-2">
                                                    <span id="dateTime" class="input-group-text"><i
                                                            class="mdi mdi-cash-multiple"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" id="total_amount"
                                                            name="total_amount" readonly
                                                            value="{{ number_format($appointment->total_amount, 2) }}"
                                                            placeholder="Total Amount" />
                                                        <label for="total_amount">Total Amount</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating form-floating-outline my-2">
                                            <textarea class="form-control" name="comment" rows="2" id="comment"></textarea>
                                            <label for="comment">Comment</label>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <button class="btn btn-outline-secondary btn-prev">
                                            <i class="mdi mdi-arrow-left me-sm-1 me-0"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary submitBtn">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var imageIds = [];

            // Attach a click event handler to the remove buttons
            var removeButtons = document.querySelectorAll(".remove-button-multiple");
            removeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var imageId = button.getAttribute("data-image-id");
                    // Check if the imageId is not already in the array before adding it
                    if (imageIds.indexOf(imageId) === -1) {
                        imageIds.push(imageId);
                    }
                    // Update the hidden input field's value with the array as a JSON string
                    document.getElementById('image-ids-input').value = JSON.stringify(imageIds);
                    // Optionally, remove the deleted image from the preview
                    button.parentElement.remove();
                });
            });
        });
    </script>



    <script>
        // Create an array to store selected files
        let selectedFiles = [];

        function updateImagePreviews(input) {
            const imagePreviewBox = document.getElementById('image-preview-box');
            imagePreviewBox.innerHTML = '';

            const files = Array.from(input.files);

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();
                reader.onload = (function(index) {
                    return function(e) {
                        const imageDiv = document.createElement('div');
                        imageDiv.className = 'image-preview';

                        const image = document.createElement('img');
                        image.className = 'profile-pic-preview';
                        image.src = e.target.result;
                        image.alt = 'Image Preview';

                        const removeButton = document.createElement('button');
                        removeButton.className = 'remove-button-multiple';
                        removeButton.textContent = 'x';

                        removeButton.addEventListener('click', function() {
                            // Remove the corresponding file from the array
                            selectedFiles.splice(index, 1);
                            // Update the hidden input with the updated file names
                            document.getElementById('profile-pic-hidden').value = selectedFiles.join(
                                ', ');
                            // Update the image preview box
                            imagePreviewBox.removeChild(imageDiv);
                        });

                        imageDiv.appendChild(image);
                        imageDiv.appendChild(removeButton);
                        imageDiv.style.height = '145px';
                        imagePreviewBox.appendChild(imageDiv);
                        imagePreviewBox.style.display = 'flex';
                        document.getElementById('current_files').style.display = "block";

                        // Add the file to the selectedFiles array
                        selectedFiles.push(file.name);
                        // Update the hidden input with the current file names
                        document.getElementById('profile-pic-hidden').value = selectedFiles.join(', ');
                    };
                })(i);

                reader.readAsDataURL(file);
            }
        }

        const profilePicInput = document.getElementById('profile-pic-input');
        profilePicInput.addEventListener('change', function() {
            updateImagePreviews(this);
        });
    </script>
    <script>
        $('#appointmentStatusForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = $(this).serialize(); // Serialize the form data
            $.ajax({
                type: 'POST',
                url: "{{ url('/api/appointment-detail/save') }}",
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {

                        $('#appointmentStatusForm')[0].reset();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Appointment Updated Successfully!',
                            showConfirmButton: false,
                            timer: 2500
                        });
                        $.ajax({
                            type: 'GET',
                            url: "{{ url('/api/appointment-visits') }}/" +
                                {{ $appointment->id }},
                            dataType: 'json',
                            success: function(data) {
                                var select = document.getElementById("visit_no_dropdown");

                                select.innerHTML = "";

                                var defaultOption = document.createElement("option");
                                defaultOption.text = "Select";
                                defaultOption.value = "";
                                select.appendChild(defaultOption);

                                data.data.forEach(function(item) {
                                    var option = document.createElement("option");
                                    option.text = item.visit_no;
                                    option.value = item.visit_no;
                                    select.appendChild(option);
                                });
                            },
                            error: function(error) {
                                console.error('Second AJAX Error:', error);
                            }
                        });

                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: 'Error',
                            text: 'Something Went Wrong!',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                },
                error: function(error) {
                    console.error('AJAX Error:', error);
                }
            });
        });
        $(document).ready(function() {
            var $amountPaid = $('#amount_paid');
            var $amountRemaining = $('#amount_remaining');
            var $totalAmount = $('#total_amount');

            var amountRemainingValue = $amountRemaining.val();
            var amountRemaining = parseFloat(amountRemainingValue.replace(/,/g, ''));

            $amountPaid.on('input', function() {
                var amountPaid = $amountPaid.val();

                if (amountPaid === '') {
                    // Handle the case when the input is empty
                    $amountRemaining.val(amountRemainingValue);
                } else {
                    var parsedAmountPaid = parseFloat(amountPaid);

                    if (!isNaN(parsedAmountPaid) && !isNaN(amountRemaining)) {
                        if (parsedAmountPaid <= amountRemaining) {
                            var remainingAmount = amountRemaining - parsedAmountPaid;
                            $amountRemaining.val(remainingAmount.toFixed(2));
                        } else {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'warning',
                                title: 'Amount Paid cannot exceed the Total Amount!',
                                showConfirmButton: false,
                                timer: 2500
                            });
                            $amountPaid.val(amountRemainingValue);
                            $amountRemaining.val('0.00');
                        }
                    }
                }
            });
        });
    </script>
@endsection
