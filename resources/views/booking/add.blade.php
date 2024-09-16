<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="GET" id="myForm" class="modal-content" action="{{ url('/appointment/add') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="modalCenterTitle">Appointment</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group input-group-merge mb-2">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                class="mdi mdi-account-outline"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" required class="form-control name-validate"
                                id="basic-icon-default-fullname" placeholder="Enter Your Patient Name" name="name"
                                aria-label="Enter description" aria-describedby="basic-icon-default-fullname2" />
                            <label for="basic-icon-default-fullname">Patient Name</label>
                        </div>
                    </div>
                    <span class="text-danger validation-name" style="display: none;">
                        <i class="mdi mdi-alert"></i> Name is invalid
                    </span>
                    {{-- <div class="input-group input-group-merge mb-2">
                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                class="mdi mdi-nature-people-outline"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input required name="nature" type="text" id="basic-icon-default-phone"
                                class="form-control phone-mask" placeholder="Enter Nature"
                                aria-label="Enter Nature" aria-describedby="basic-icon-default-phone2" />
                            <label for="basic-icon-default-phone">Nature</label>
                        </div>
                    </div> --}}
                    <div class="form-floating form-floating-outline my-3">
                        <select required name="doctor" type="text" class="select2 form-select form-select-lg"
                            data-allow-clear="true">
                            <option value="">Select</option>
                            <option value="Expenses">Expenses</option>
                            <option value="In Expenses">In Expenses</option>

                        </select>
                        <label for="doctor">Doctor</label>
                    </div>
                    <div class="input-group input-group-merge mb-2">
                        <div class="input-group input-group-merge">
                            {{-- <span class="input-group-text">With textarea</span> --}}
                            <div class="form-floating form-floating-outline">
                              <textarea
                                class="form-control h-px-75"
                                aria-label="With textarea"
                                placeholder="Enter Your Comment"></textarea>
                              <label>Comment</label>
                            </div>
                          </div>
                    </div>
                    <div class="input-group input-group-merge mb-2">

                        <div class="form-floating form-floating-outline my-2">
                            <input name="profile_pic" class="form-control" type="file"
                                id="formValidationFile" name="profile_pic" accept=".png, .jpeg, .jpg, .pdf, .svg"/>
                            <label for="formValidationFile">Profile Pic</label>
                        </div>
                    </div>

                    {{-- <div class="input-group input-group-merge mb-2">
                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                class="mdi  mdi-alpha-g"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input required name="general" type="text" id="basic-icon-default-phone"
                                class="form-control phone-mask" placeholder="Enter General"
                                aria-label="Enter General." aria-describedby="basic-icon-default-phone2" />
                            <label for="basic-icon-default-phone">General</label>
                        </div>
                    </div> --}}
                {{-- </div> --}}
                <div class="form-floating form-floating-outline my-2">
                    <select required name="procedure" type="text" class="select2 form-select form-select-lg"
                        data-allow-clear="true">
                        <option value="">Select</option>
                        <option value="Current Assets">Current Assets</option>
                        <option value="In-Direct expenses">In-Direct Expenses</option>

                    </select>
                    <label for="procedure">Procedure</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary submitBtn" id="submitBtn" >Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
