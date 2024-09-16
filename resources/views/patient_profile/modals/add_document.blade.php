<style>
    .file-preview {
        margin: 5px; /* Add margin for spacing between file previews */
        padding: 10px; /* Add padding to create space around each file preview */
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
        background-color: #3b91e1 !important; /* Set background color to match file preview background */
        border: none;
        color: #fff; /* Set color to match the remove button with the background */
        cursor: pointer;
        font-weight: bold;
        font-size: 14px;
    }
</style>
<div class="modal fade" id="modalCenters" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" id="myForm" action="{{ url('/add-documents' . '/' . $customer->id) }}"
                enctype="multipart/form-data" id="formValidationExamples" class="row g-3">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="modalCenterTitle">Add Documents</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="{{ $customer->id }}" name="customer_head_id">
                    <input type="hidden" value="3" name="customer_type_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-merge mb-3">
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
                        <div class="col-md-6">
                            <div class="input-group input-group-merge mb-2">
                                <span id="basic-icon-default-phone2" class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                <div class="form-floating form-floating-outline">
                                    <input name="dob" type="date" id="dateOfBirth"
                                           class="form-control dob-validate" placeholder="DD/MM/YYYY"
                                           aria-describedby="basic-icon-default-phone2" onchange="calculateAge()" />
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
                                    <input required name="passport_number" type="text" id="basic-icon-default-phone"
                                        class="form-control phone-mask number-validate" placeholder="Enter Your Number"
                                        aria-label="Enter Phone No." aria-describedby="basic-icon-default-phone2" />
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
                                    <input required name="date_of_issue" type="date" id="basic-icon-default-phone"
                                        class="form-control" placeholder="YYYY-MM-DD"
                                        aria-label="YYYY-MM-DD" aria-describedby="basic-icon-default-phone2" />
                                    <label for="basic-icon-default-phone">Date Of Issue</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-merge my-2">
                                <span id="basic-icon-default-phone2" class="input-group-text"><i
                                        class="mdi mdi-calendar"></i></span>
                                <div class="form-floating form-floating-outline">
                                    <input required name="date_of_expiry" type="date" id="basic-icon-default-phone"
                                        class="form-control" placeholder="YYYY-MM-DD"
                                        aria-label="YYYY-MM-DD" aria-describedby="basic-icon-default-phone2" />
                                    <label for="basic-icon-default-phone">Date Of Expiry</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-merge my-2">
                                <span class="input-group-text"><i class="mdi mdi-counter"></i></span>
                                <div class="form-floating form-floating-outline">
                                    <input readonly type="number" name="age" id="age"
                                        class="form-control" placeholder="Enter Age" aria-label="Enter Age"
                                        aria-describedby="age2" />
                                    <label for="age">Age</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline my-2">
                                <textarea class="form-control" name="description" rows="5" id="description"></textarea>
                                <label for="description">Description</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text"><i
                                        class="mdi mdi-image-outline"></i></span>
                                <div class="form-floating form-floating-outline">
                                    <div class="custom-file-upload">
                                        <label for="lab-report-image" class="custom-file-label">Choose files</label>
                                        <input type="file" name="images[]" class="lab-report-image" id="lab-report-image"
                                            accept=".png, .jpeg, .jpg, .pdf, .svg" multiple />
                                    </div>
                                </div>
                            </div>
                            <label id="lab_current_files" class="mt-2" style="display: none" for="lab_current_files">Current Files:</label>
                            <div class="lab-image-preview-box" id="lab-image-preview-box"></div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary submitBtn" id="submitBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script>
    function calculateAge() {
        var dob = new Date(document.getElementById("dateOfBirth").value);
        var today = new Date();
        var age = today.getFullYear() - dob.getFullYear();

        // Check if the birthday has occurred this year
        if (today.getMonth() < dob.getMonth() ||
            (today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())) {
            age--;
        }

        // Set the calculated age to the age input field
        document.getElementById("age").value = age;
    }
</script>

<script>
    // Create an array to store selected files
    let selectedlabReportFiles = [];

    function updateLabImagePreviews(input) {
        const imagePreviewBox = document.getElementById('lab-image-preview-box');
        imagePreviewBox.innerHTML = '';

        const files = Array.from(input.files);

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();
            reader.onload = (function (index) {
                return function (e) {
                    const filePreview = document.createElement('div');
                    filePreview.className = 'file-preview';

                    // Use a dynamic ID based on the index
                    filePreview.id = 'file-preview-' + index;

                    if (file.type.startsWith('image/')) {
                        // For images
                        const image = document.createElement('img');
                        image.className = 'profile-pic-preview';
                        image.src = e.target.result;
                        image.alt = 'Image Preview';
                        filePreview.appendChild(image);
                    } else if (file.type === 'application/pdf') {
                        // For PDFs
                        const embed = document.createElement('embed');
                        embed.src = e.target.result;
                        embed.type = 'application/pdf';
                        embed.width = '100%';
                        embed.height = '300px';
                        filePreview.appendChild(embed);
                    } else {
                        // For other file types (you can customize this part)
                        const message = document.createElement('p');
                        message.textContent = 'Unsupported file type';
                        filePreview.appendChild(message);
                    }

                    const removeButton = document.createElement('button');
                    removeButton.className = 'remove-button-multiple';
                    removeButton.type = 'button';
                    removeButton.textContent = 'x';

                    removeButton.addEventListener('click', function () {
                        // Remove the corresponding file from the array
                        selectedlabReportFiles.splice(index, 1);
                        // Update the hidden input with the updated file names
                        // Update the image preview box
                        imagePreviewBox.removeChild(filePreview);
                        updateHiddenInput();
                    });

                    filePreview.appendChild(removeButton);
                    imagePreviewBox.appendChild(filePreview);
                    imagePreviewBox.style.display = 'flex';
                    document.getElementById('lab_current_files').style.display = 'block';

                    // Add the file to the selectedlabReportFiles array
                    selectedlabReportFiles.push(file.name);
                    // Update the hidden input with the current file names
                    updateHiddenInput();
                };
            })(i);

            reader.readAsDataURL(file);
        }
    }

    function updateHiddenInput() {
        const hiddenInput = document.getElementById('lab_current_files');
        hiddenInput.value = selectedlabReportFiles.join(', ');
    }

    const labReportInput = document.getElementById('lab-report-image');
    labReportInput.addEventListener('change', function () {
        updateLabImagePreviews(this);
    });
</script>

