@extends('layout.master')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center p-3 py-0">
            <h4 class="fw-bold py-3 mb-2"><a href="{{ url('dashboard') }}" class="text-muted fw-light">Dashboard </a>
                <span class="color">/
                    Booking
                </span>
            </h4>
            <a href="{{ url('get-beds24-bookings') }}" class="btn btn-primary">Sync</a>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card app-calendar-wrapper">
                    <div class="row g-0">
                        <!-- Calendar Sidebar -->
                        <div class="col app-calendar-sidebar pt-1" id="app-calendar-sidebar">
                            {{-- <div class="p-3 pb-2 my-sm-0 mb-3">
                        <div class="d-grid">
                            <button class="btn btn-primary btn-toggle-sidebar" data-bs-toggle="offcanvas"
                                data-bs-target="#addEventSidebar">
                                <i class="mdi mdi-plus me-1"></i>
                                <span class="align-middle">Add Appointment</span>
                            </button>
                        </div>
                    </div> --}}
                            <div class="p-4">

                                {{-- <hr class="container-m-nx my-4" /> --}}

                                <!-- Filter -->
                                <div class="mb-4">
                                    <small class="text-small text-muted text-uppercase align-middle">Filter</small>
                                </div>

                                <div class="form-check  form-check-primary mb-3">
                                    <input class="form-check-input select-all" type="checkbox" id="selectAll"
                                        data-value="all" checked />
                                    <label class="form-check-label" for="selectAll">View All</label>
                                </div>

                                <div class="app-calendar-events-filter">
                                    @foreach ($products as $product)
                                        <div class="form-check form-check-priamry mb-3">
                                            <input class="form-check-input input-filter" type="checkbox"
                                                id="select-personal" data-value="{{ $product->id }}" checked />
                                            <label class="form-check-label"
                                                for="select-personal">{{ $product->name }}</label>
                                        </div>
                                    @endforeach
                                    {{-- <div class="form-check mb-3">
                                <input class="form-check-input input-filter" type="checkbox" id="select-business"
                                    data-value="business" checked />
                                <label class="form-check-label" for="select-business">Business</label>
                            </div>
                            <div class="form-check form-check-warning mb-3">
                                <input class="form-check-input input-filter" type="checkbox" id="select-family"
                                    data-value="family" checked />
                                <label class="form-check-label" for="select-family">Family</label>
                            </div>
                            <div class="form-check form-check-success mb-3">
                                <input class="form-check-input input-filter" type="checkbox" id="select-holiday"
                                    data-value="holiday" checked />
                                <label class="form-check-label" for="select-holiday">Holiday</label>
                            </div>
                            <div class="form-check form-check-info">
                                <input class="form-check-input input-filter" type="checkbox" id="select-etc"
                                    data-value="etc" checked />
                                <label class="form-check-label" for="select-etc">ETC</label>
                            </div> --}}
                                </div>
                            </div>
                        </div>
                        <!-- /Calendar Sidebar -->

                        <!-- Calendar & Modal -->
                        <div class="col app-calendar-content">
                            <div class="card shadow-none border-0 border-start rounded-0">
                                <div class="card-body pb-0">
                                    <!-- FullCalendar -->
                                    <div id="calendar"></div>
                                </div>
                            </div>
                            <div class="app-overlay"></div>
                            <!-- FullCalendar Offcanvas -->
                            <div class="offcanvas offcanvas-end event-sidebar" tabindex="-1" id="addEventSidebar"
                                aria-labelledby="addEventSidebarLabel">
                                <div class="offcanvas-header pb-0">
                                    <h5 class="offcanvas-title" id="addEventSidebarLabel">Add Booking</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="form-floating form-floating-outline w-px-200 d-none patient-status-select">
                                            <select id="customer_status" required name="customer_status" type="text"
                                                class="select2 form-select form-select-lg" data-allow-clear="true">
                                                <option value="scheduled">Scheduled</option>
                                                <option value="checked-in">Checked In</option>
                                                <option value="checked-out">Checked Out</option>
                                                <option value="cancelled">Cancelled</option>
                                            </select>
                                            <label for="Status">Status</label>
                                        </div>
                                        <button class="btn btn-primary btn-detail me-sm-2 me-1 calendar-button">Customer Profile</button>
                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                                <div class="offcanvas-body">
                                    <form class="event-form pt-0" id="eventForm" onsubmit="return false">
                                        <div class="row">
                                            <input type="hidden" class="form-control" id="booking_id" name="booking_id" />
                                            <div class="col-md-6">
                                                <div class="input-group input-group-merge my-2">
                                                    <span id="dateTime" class="input-group-text"><i
                                                            class="mdi mdi-calendar"></i></span>
                                                    <div class="form-floating form-floating-outline disabled">
                                                        <input type="text" class="form-control" id="booking_start"
                                                            disabled name="booking_start" required
                                                            placeholder="Booking Start" />
                                                        <label for="booking_start">Booking Start</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group input-group-merge my-2">
                                                    <span id="dateTime" class="input-group-text"><i
                                                            class="mdi mdi-calendar"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" id="booking_end"
                                                            name="booking_end" required placeholder="Booking End" 
                                                            {{-- onchange="calculateNightsAndSetCharges()"  --}}
                                                            />
                                                        <label for="booking_end">Booking End</label>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="input-group input-group-merge my-2 d-none">
                                                    <span id="day" class="input-group-text"><i
                                                            class="mdi mdi-calendar"></i></span>
                                                    <div class="form-floating form-floating-outline disabled">
                                                        <input type="hidden" readonly class="form-control" id="booking_day"
                                                            name="day" required placeholder="Day" />
                                                        <input type="hidden" class="form-control" id="day_id"
                                                            name="day_id" />
                                                        <label for="day">Day</label>
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                <div class="form-floating form-floating-outline my-2">
                                                    <select id="customer_id" required name="customer_id" type="text"
                                                        class="select2 form-select form-select-lg"
                                                        data-allow-clear="true">
                                                        <option value="">Select</option>
                                                        @foreach ($customers as $customer)
                                                            <option value="{{ $customer->id }}">
                                                                {{ $customer->name }} </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="customers">Customer</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating form-floating-outline my-2">
                                                    <select id="product_id" required name="product_id" type="text"
                                                        {{-- oninput="getProductId()" --}}
                                                        class="select2 form-select form-select-lg"
                                                        data-allow-clear="true">
                                                        <option value="">Select</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}">{{ $product->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="products">Product</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group input-group-merge my-2">
                                                    <span class="input-group-text"><i
                                                            class="mdi mdi-cash-multiple"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" class="form-control" id="charges"
                                                            name="charges" required placeholder="Enter Charges" />
                                                        <label for="charges">Charges</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group input-group-merge my-2">
                                                    <span class="input-group-text"><i class="mdi mdi-numeric"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" class="form-control" id="no_of_nights"
                                                            name="no_of_nights" 
                                                            placeholder="Enter No. Of Nights" />
                                                        <label for="no_of_nights">No. Of Nights</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group input-group-merge my-2">
                                                    <span class="input-group-text"><i class="mdi mdi-numeric"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" class="form-control" id="num_of_adults"
                                                            name="num_of_adults" 
                                                            placeholder="Enter No. Of Adults" />
                                                        <label for="num_of_adults">No. Of Adults</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group input-group-merge my-2">
                                                    <span class="input-group-text"><i class="mdi mdi-numeric"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" class="form-control" id="num_of_child"
                                                            name="num_of_child" 
                                                            placeholder="Enter No. Of Child" />
                                                        <label for="num_of_child">No. Of Child</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group input-group-merge my-2">
                                                    <span class="input-group-text"><i
                                                            class="mdi mdi-percent-outline"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" step="0.01" class="form-control" id="discount"
                                                            name="discount" placeholder="Enter Discount %" />
                                                        <label for="discount">Discount</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group input-group-merge my-2">
                                                    <span class="input-group-text"><i
                                                            class="mdi mdi-percent-outline"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" step="0.01" class="form-control" id="tax"
                                                            name="tax" placeholder="Enter Tax %" />
                                                        <label for="tax">Tax</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group input-group-merge my-2">
                                                    <span class="input-group-text"><i
                                                            class="mdi mdi-cash-multiple"></i></span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" step="0.01" class="form-control" id="amount"
                                                            name="amount" required placeholder="Enter Amount" />
                                                        <label for="amount">Amount</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-floating form-floating-outline my-2">
                                                    <textarea class="form-control" name="comment" rows="5" id="comment"></textarea>
                                                    <label for="comment">Comment</label>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12">
                                        <div class="dropzone needsclick my-2" id="dropzone-multi">
                                            <div class="dz-message needsclick my-3 fs-5">
                                                Drop files here or click to upload
                                                <span class="note needsclick fs-6">(This is just a demo dropzone. Selected
                                                    files are
                                                    <strong>not</strong> actually
                                                    uploaded.)</span>
                                            </div>
                                            <div class="fallback">
                                                <input id="file" name="file" type="file" />
                                            </div>
                                        </div>
                                    </div> --}}
                                        </div>
                                        <div
                                            class="mb-3 d-flex justify-content-sm-between justify-content-start my-4 gap-2">
                                            <div class="d-flex">
                                                <button type="submit"
                                                    class="btn btn-primary btn-add-event me-sm-2 me-1">Add</button>
                                                <button type="reset"
                                                    class="btn btn-label-secondary btn-cancel me-sm-0 me-1"
                                                    data-bs-dismiss="offcanvas">
                                                    Cancel
                                                </button>
                                            </div>
                                            <button class="btn btn-label-danger btn-delete-event d-none">Delete</button>
                                        </div>
                                    </form>
                                    {{-- <form class="event-form pt-0" id="eventForm" onsubmit="return false"> --}}
                                    {{-- <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="eventTitle" name="eventTitle"
                                        placeholder="Event Title" />
                                    <label for="eventTitle">Title</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <select class="select2 select-event-label form-select" id="eventLabel"
                                        name="eventLabel">
                                        <option data-label="primary" value="Business" selected>Business</option>
                                        <option data-label="danger" value="Personal">Personal</option>
                                        <option data-label="warning" value="Family">Family</option>
                                        <option data-label="success" value="Holiday">Holiday</option>
                                        <option data-label="info" value="ETC">ETC</option>
                                    </select>
                                    <label for="eventLabel">Label</label>
                                </div>

                                <div class="mb-3">
                                    <label class="switch">
                                        <input type="checkbox" class="switch-input allDay-switch" />
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on"></span>
                                            <span class="switch-off"></span>
                                        </span>
                                        <span class="switch-label">All Day</span>
                                    </label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="url" class="form-control" id="eventURL" name="eventURL"
                                        placeholder="https://www.google.com" />
                                    <label for="eventURL">Event URL</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4 select2-primary">
                                    <select class="select2 select-event-guests form-select" id="eventGuests"
                                        name="eventGuests" multiple>
                                        <option data-avatar="1.png" value="Jane Foster">Jane Foster</option>
                                        <option data-avatar="3.png" value="Donna Frank">Donna Frank</option>
                                        <option data-avatar="5.png" value="Gabrielle Robertson">Gabrielle Robertson
                                        </option>
                                        <option data-avatar="7.png" value="Lori Spears">Lori Spears</option>
                                        <option data-avatar="9.png" value="Sandy Vega">Sandy Vega</option>
                                        <option data-avatar="11.png" value="Cheryl May">Cheryl May</option>
                                    </select>
                                    <label for="eventGuests">Add Guests</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="eventLocation" name="eventLocation"
                                        placeholder="Enter Location" />
                                    <label for="eventLocation">Location</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <textarea class="form-control" name="eventDescription" id="eventDescription"></textarea>
                                    <label for="eventDescription">Description</label>
                                </div> --}}

                                    {{-- </form> --}}
                                </div>
                            </div>
                        </div>
                        <!-- /Calendar & Modal -->
                    </div>
                </div>
            </div>
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
            var $no_of_nights = $("#no_of_nights");
            var $amount = $("#amount");
    
            // Listen for changes in the input fields
            $charges.on("input", calculateTotalAmount);
            $discount.on("input", calculateTotalAmount);
            $tax.on("input", calculateTotalAmount);
            $share.on("input", calculateTotalAmount);
            // $("#no_of_nights").on("change", calculateTotalAmount);
            $no_of_nights.on("input", calculateTotalAmount);
    
            // Function to calculate the total amount
            function calculateTotalAmount() {
                // Parse values and ensure they are numeric
                var charges = parseFloat($charges.val()) || 0;
                var discountPercentage = parseFloat($discount.val()) || 0;
                var taxPercentage = parseFloat($tax.val()) || 0;
                var sharePercentage = parseFloat($share.val()) || 0;
                var no_of_nights = parseFloat($no_of_nights.val()) || 0;
    
                // Calculate amounts
                var discountAmount = (discountPercentage / 100) * charges;
                var taxAmount = (taxPercentage / 100) * charges;
                var shareAmount = (sharePercentage / 100) * charges;
    
                // Calculate total amount
                var amount = charges * no_of_nights - discountAmount + taxAmount - shareAmount;
    
                // Update the total amount field
                $amount.val(amount.toFixed(2)); // Display with 2 decimal places
            }
    
            // Function to calculate nights and set charges
            function calculateNightsAndSetCharges() {
                var startDate = new Date(document.getElementById("booking_start").value);
                var endDate = new Date(document.getElementById("booking_end").value);
    
                // Calculate the difference in milliseconds
                var timeDifference = endDate.getTime() - startDate.getTime();
    
                // Calculate the number of nights
                var numberOfNights = timeDifference / (1000 * 3600 * 24);
    
                // Round up to the nearest integer
                numberOfNights = Math.ceil(numberOfNights);
    
                // Set the calculated value to the number of nights input field
                $no_of_nights.val(numberOfNights);
    
                // Call calculateTotalAmount
                calculateTotalAmount();
            }
    
            // Function to fetch product details
            function getProductId() {
                var select = document.getElementById("product_id");
                var selectedProduct = select.options[select.selectedIndex].value;
    
                $.ajax({
                    type: "POST",
                    data: {
                        "product_id": selectedProduct,
                    },
                    url: "{{ url('api/product/getById') }}",
                    dataType: 'json',
                    success: function(result) {
                        var data = result.data;
                        $charges.val(data.price);
                        calculateTotalAmount();
                    }
                });
            }
    
            // Call calculateNightsAndSetCharges when booking dates change
            $("#booking_start, #booking_end").on("change", calculateNightsAndSetCharges);
    
            // Call getProductId when product selection changes
            $("#product_id").on("change", getProductId);
        });
    </script>
    
    {{-- <script>
        function calculateNights() {
        var startDate = new Date(document.getElementById("booking_start").value);
        var endDate = new Date(document.getElementById("booking_end").value);

        // Calculate the difference in milliseconds
        var timeDifference = endDate.getTime() - startDate.getTime();

        // Calculate the number of nights
        var numberOfNights = timeDifference / (1000 * 3600 * 24);

        // Round up to the nearest integer
        numberOfNights = Math.ceil(numberOfNights);

        // Set the calculated value to the number of nights input field
        document.getElementById("no_of_nights").value = numberOfNights;
         // Trigger the change event on no_of_nights
        $("#no_of_nights").trigger("change");
    }
    </script>
    <script>
        $(document).ready(function() {
            // Select the input fields and the result field
            var $charges = $("#charges");
            var $discount = $("#discount");
            var $tax = $("#tax");
            var $share = $("#share");
            var $no_of_nights = $("#no_of_nights");
            var $amount = $("#amount");

            // Listen for changes in the input fields
            $charges.on("input", calculateTotalAmount);
            $discount.on("input", calculateTotalAmount);
            $tax.on("input", calculateTotalAmount);
            $no_of_nights.on("change", calculateTotalAmount);
            $share.on("input", calculateTotalAmount);

            // Function to calculate the total amount
            function calculateTotalAmount() {
                // Parse values and ensure they are numeric
                var charges = parseFloat($charges.val()) || 0;
                var discountPercentage = parseFloat($discount.val()) || 0;
                var taxPercentage = parseFloat($tax.val()) || 0;
                var sharePercentage = parseFloat($share.val()) || 0;
                var no_of_nights = parseFloat($("#no_of_nights").val()) || 0;
                console.log(no_of_nights);




                // Calculate amounts
                var discountAmount = (discountPercentage / 100) * charges;
                var taxAmount = (taxPercentage / 100) * charges;
                var shareAmount = (sharePercentage / 100) * charges;

                // Calculate total amount
                var amount = charges * no_of_nights - discountAmount + taxAmount - shareAmount;

                // Update the total amount field
                $amount.val(amount.toFixed(2)); // Display with 2 decimal places
            }
        });

        function getProductId() {
            var select = document.getElementById("product_id");
            var selectedProduct = select.options[select.selectedIndex].value;

            $.ajax({
                type: "POST",
                data: {
                    "product_id": selectedProduct,
                },
                url: "{{ url('api/product/getById') }}",
                dataType: 'json',
                success: function(result) {
                    var data = result.data;
                    document.getElementById("charges").value = data.price;
                }
            })
        };
    </script> --}}
@endsection
