@extends('layout.master')

@section('content')
    <style>
        .file-preview {
            margin: 5px;
            /* Add margin for spacing between file previews */
            padding: 10px;
            /* Add padding to create space around each file preview */
            position: relative;
        }

        .profile-pic-preview {
            max-width: 100%;
            max-height: 100%;
        }

        .remove-button-multiple {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #3b91e1 !important;
            /* Set background color to match file preview background */
            border: none;
            color: #fff;
            /* Set color to match the remove button with the background */
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a
                href="{{ url('/customers') }}" class="text-muted fw-light">/ Customer Document</a><span class="color">
                /</span><span class="text-heading fw-bold text-color"> Edit</span>
        </h4>
        <div class="row">
            <!-- FormValidation -->
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Edit Document</h5>
                    <div class="card-body">
                        <form method="POST" id="myForm"
                            action="{{ url('/edit-documents' . '/' . $customer->id . '/' . $customerdocument->id) }}"
                            enctype="multipart/form-data" id="formValidationExamples" class="row g-3">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="mdi mdi-account-outline"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" required class="form-control name-validate"
                                                value="{{ $customerdocument->name }}" id="basic-icon-default-fullname"
                                                placeholder="Enter Name" name="name" aria-label="Enter Name"
                                                aria-describedby="basic-icon-default-fullname2" />
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
                                                class="mdi mdi-calendar"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input name="dob" type="date" id="bs-datepicker-format"
                                                class="form-control dob-validate" placeholder="DD/MM/YYYY"
                                                value="{{ $customerdocument->dob }}"
                                                aria-describedby="basic-icon-default-phone2" />
                                            <label for="basic-icon-default-phone">Date Of Birth</label>
                                        </div>
                                    </div>
                                    <span class="text-danger validation-dob" style="display: none;">
                                        <i class="mdi mdi-alert"></i> Date of birth cannot be in the future
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="mdi mdi-passport"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input required name="passport_number" type="text"
                                                id="basic-icon-default-phone"
                                                value="{{ $customerdocument->passport_number }}"
                                                class="form-control phone-mask number-validate"
                                                placeholder="Enter Your Number" aria-label="Enter Phone No."
                                                aria-describedby="basic-icon-default-phone2" />
                                            <label for="basic-icon-default-phone">Passport No</label>
                                        </div>
                                    </div>
                                    <span class="text-danger validation-number" style="display: none;">
                                        <i class="mdi mdi-alert"></i> Number is invalid
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="mdi mdi-calendar"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input required name="date_of_issue" type="date"
                                                id="basic-icon-default-phone" value="{{ $customerdocument->date_of_issue }}"
                                                class="form-control" placeholder="YYYY-MM-DD" aria-label="YYYY-MM-DD"
                                                aria-describedby="basic-icon-default-phone2" />
                                            <label for="basic-icon-default-phone">Date Of Issue</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="mdi mdi-calendar"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input required name="date_of_expiry" type="date"
                                                id="basic-icon-default-phone"
                                                value="{{ $customerdocument->date_of_expiry }}" class="form-control"
                                                placeholder="YYYY-MM-DD" aria-label="YYYY-MM-DD"
                                                aria-describedby="basic-icon-default-phone2" />
                                            <label for="basic-icon-default-phone">Date Of Expiry</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span class="input-group-text"><i class="mdi mdi-counter"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input readonly type="number" name="age" id="basic-icon-default-email"
                                                value="{{ $customerdocument->age }}" class="form-control"
                                                placeholder="Enter Age" aria-label="Enter Age"
                                                aria-describedby="basic-icon-default-email2" />
                                            <label for="basic-icon-default-email">Age</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating form-floating-outline my-2">
                                        <textarea class="form-control" name="description" rows="5" id="description">{{ $customerdocument->description }}</textarea>
                                        <label for="description">Description</label>
                                    </div>
                                </div>


                                {{-- <div class="col-md-12">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-image-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <div class="custom-file-upload">
                                            <label for="lab-report-image" class="custom-file-label">Choose files</label>
                                            <input type="file" name="images[]" class="lab-report-image" id="lab-report-image"
                                                accept=".png, .jpeg, .jpg, .pdf, .svg" multiple />
                                                @if ($customerdocumentimage->images)
                                                <p class="mt-2">Current File: {{ $customerdocumentimage->images }}</p>
                                            @else
                                                <p class="mt-2">No file selected.</p>
                                            @endif
                                            @if ($customerdocumentimage->images)
                                                <img width="100px" height="100px" src="{{ url('uploads/' . $customerdocumentimage->images) }}"
                                                    alt="">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <label id="lab_current_files" class="mt-2" style="display: none" for="lab_current_files">Current Files:</label>
                                <div class="lab-image-preview-box" id="lab-image-preview-box"></div>
                            </div> --}}
                                <div class="col-md-12">
                                    <div class="input-group input-group-merge mb-2">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="mdi mdi-image-outline"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <div class="custom-file-upload">
                                                <label for="profile-pic-input" class="custom-file-label">Choose
                                                    files</label>
                                                <input type="file" name="images[]" class="profile-pic-input"
                                                    id="profile-pic-input" accept=".png, .jpeg, .jpg, .pdf, .svg"
                                                    multiple />
                                                <input type="hidden" id="profile-pic-hidden" name="images_hidden[]"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <label id="current_files" style="display: none" for="current_files">Current
                                        Files:</label>
                                    <div class="image-preview-box" id="image-preview-box">
                                    </div>
                                    @if ($customerdocument->customerDocumentImages)
                                        <label for="uploaded_files">Uploaded Files:</label>
                                        <div class="image-preview-box" style="display:flex; height:145px;">
                                            @foreach ($customerdocument->customerDocumentImages as $image)
                                                <div class="image-preview">
                                                    <button class="remove-button-multiple"
                                                        data-image-id="{{ $image->id }}">x</button>
                                                    <img class="profile-pic-preview"
                                                        src="{{ url('uploads/' . $image->images) }}" alt="Doc" />
                                                </div>
                                            @endforeach
                                            <input type="hidden" id="image-ids-input" name="image_ids" value="">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12 mt-5">
                                    <a href="{{ url('/customer-profile/' . $customer->id) }}" type="back"
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
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Attach a click event handler to the remove button
        var removeButton = document.querySelector(".remove-button");

        removeButton.addEventListener('click', function() {
            // Remove the image preview by removing the whole image-preview-box
            var imagePreviewBox = document.querySelector(".image-preview-box");
            imagePreviewBox.remove();

            // Optionally, you can reset the value of the hidden input field if needed
            document.getElementById('profile-pic-input').value = "";
            document.getElementsByClassName("custom-file-label")[0].innerHTML = "Choose a file";

        });
    });
</script>
