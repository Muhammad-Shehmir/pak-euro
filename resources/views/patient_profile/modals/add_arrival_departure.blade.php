<div class="modal fade" id="modalarr_dep" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" id="myForm" action="{{ url('/add-arr-dep' . '/' . $customer->id) }}"
                enctype="multipart/form-data" id="formValidationExamples" class="row g-3">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="modalCenterTitle">Add Arrival Departure</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="{{ $customer->id }}" name="customer_head_id">
                    <input type="hidden" value="3" name="customer_type_id">
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <div class="form-floating form-floating-outline">
                                <select id="arrival_type" name="arrival_type" class="select2 form-select form-select-lg"
                                    data-allow-clear="true">
                                    <option value="1">Self Arrival</option>
                                    <option value="2">By Air</option>
                                    <option value="3">By Boat</option>
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
                                        class="form-control phone-mask " placeholder="Enter Flight Number"
                                        aria-label="Enter Phone No." aria-describedby="basic-icon-default-phone2" />
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
                                        class="form-control" placeholder="YYYY-MM-DD"
                                        aria-label="YYYY-MM-DD" aria-describedby="basic-icon-default-phone2" />
                                    <label for="basic-icon-default-phone">Arrival Date</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-merge my-2">
                                <span id="basic-icon-default-phone2" class="input-group-text"><i
                                        class="mdi mdi-calendar"></i></span>
                                <div class="form-floating form-floating-outline">
                                    <input required name="departure_time" type="date" id="basic-icon-default-phone"
                                        class="form-control" placeholder="YYYY-MM-DD"
                                        aria-label="YYYY-MM-DD" aria-describedby="basic-icon-default-phone2" />
                                    <label for="basic-icon-default-phone">Departure Date</label>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6 boat_name">
                            <div class="input-group input-group-merge my-2">
                                <span class="input-group-text"><i class="mdi mdi-sail-boat"></i></span>
                                <div class="form-floating form-floating-outline">
                                    <input type="text" name="boat_name" id="basic-icon-default-email"
                                        class="form-control" placeholder="Enter Boat Name" aria-label="Enter Boat Name"
                                        aria-describedby="basic-icon-default-email2" />
                                    <label for="basic-icon-default-email">Boat Name</label>
                                </div>
                            </div>
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


