@extends('layout.master')
@section('content')
    <div class="container-xxl flex-grow-1  container-p-y">
        <form id="invoiceForm" method="POST">
            @csrf
            <div class="d-flex justify-content-between align-items-center p-3 py-0">
                <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a
                        href="{{ url('/booking') }}" class="text-muted fw-light">/ Booking</a><span class="color">
                        /</span><span class="text-heading fw-bold text-color"> Add</span>
                </h4>
                <div class="text-end">
                    {{-- <button type="button" value="2" name="status" class="close-bookng btn btn-primary">
                        Save & Close
                    </button> --}}
                    <button type="submit" id="submitBtn" value="1" name="status" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
            <div class="row bookng-add">
                <!-- Booking Add-->
                <div class="col-md-12">
                    <div class="card bookng-preview-card">
                        <div class="card-body pb-3">
                            <div class="row mx-0">
                                <div class="col-md-7 mb-md-0 mb-4 ps-0">
                                    <div class=" svg-illustration align-items-center gap-2">
                                        <img src="{{ url('/blue-logo.png') }}" width="150px" height="40px"
                                            class="h4 mb-0  app-brand-text fw-bold">
                                    </div>
                                    {{-- <h4 class="mb-0">Create bookng</h4> --}}

                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <input type="hidden" class="form-control" id="booking_id" name="booking_id" />
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span id="dateTime" class="input-group-text"><i
                                                class="mdi mdi-calendar"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="date" class="form-control" id="booking_start"
                                                name="booking_start" required
                                                placeholder="Booking Start" onchange="calculateNights()" />
                                            <label for="booking_start">Booking Start</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span id="dateTime" class="input-group-text"><i
                                                class="mdi mdi-calendar"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="date" class="form-control" id="booking_end"
                                                name="booking_end" required placeholder="Booking End" onchange="calculateNights()" />
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
                                                <option {{ $quote->customer_id == $customer->id ? 'selected' : '' }} 
                                                value="{{ $customer->id }}">
                                                    {{ $customer->name }} </option>
                                            @endforeach
                                        </select>
                                        <label for="customers">Customer</label>
                                    </div>
                                </div>
                                @foreach ($groupDetails as $index => $item)
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline my-2">
                                        <select id="product_id" required name="product_id" type="text"
                                            oninput="getProductId()"
                                            class="select2 form-select form-select-lg"
                                            data-allow-clear="true">
                                            <option value="">Select</option>
                                            @foreach ($products as $product)
                                                <option {{ $item->product_id == $product->id ? 'selected' : '' }} 
                                                value="{{ $product->id }}">{{ $product->name }}
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
                                                name="charges" required placeholder="Enter Charges" value="{{ $item->charges }}" />
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
                                                placeholder="Enter No. Of Nights" value="{{ $item->days_dives }}" />
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
                                                placeholder="Enter No. Of Adults" value="{{ $item->persons_rooms }}" />
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
                                                class="mdi mdi-cash-multiple"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="number" class="form-control" id="amount"
                                                name="amount" required placeholder="Enter Amount" value="{{ $item->amount }}" />
                                            <label for="amount">Amount</label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span class="input-group-text"><i
                                                class="mdi mdi-percent-outline"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="number" class="form-control" id="discount"
                                                name="discount" placeholder="Enter Discount %" value="{{ $quote->total_discount_percentage }}" />
                                            <label for="discount">Discount</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge my-2">
                                        <span class="input-group-text"><i
                                                class="mdi mdi-percent-outline"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="number" class="form-control" id="tax"
                                                name="tax" placeholder="Enter Tax %" value="{{ $quote->total_tax_percentage }}" />
                                            <label for="tax">Tax</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating form-floating-outline my-2">
                                        <textarea class="form-control" name="comment" rows="5" id="comment"></textarea>
                                        <label for="comment">Comment</label>
                                    </div>
                                </div>
                                {{-- <div class="col-md-2 mb-md-0 my-3">
                                    <div class="form-floating form-floating-outline ">
                                        <div class="select2-primary">
                                            <select id="customer_source" name="customer_source" type="text"
                                                class="select2 form-select form-select-lg" data-allow-clear="true">
                                                <option value="">Select</option>
                                                @foreach ($customer_sources as $source)
                                                    <option value="{{ $source->id }}">
                                                        {{ $source->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label for="customer_type">Customer Source</label>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- <div class="modal fade" id="bookingExistModal" tabindex="-1" aria-labelledby="bookingExistModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingExistModalLabel">Booking Already Exists</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        Booking already exists for the selected date range. Please choose different dates.
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}

    <script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script>
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
    }
    </script>
    <script>
        $(document).ready(function() {
            // Assuming you have a button or form to trigger the booking creation process
            $('#submitBtn').click(function(e) {
                e.preventDefault(); // Prevent the default form submission behavior

                // Data to send in the request
                var formData = {
                    booking_start: $('#booking_start').val(),
                    booking_end: $('#booking_end').val(),
                    day_id: $('#day_id').val(),
                    customer_id: $('#customer_id').val(),
                    product_id: $('#product_id').val(),
                    no_of_nights: $('#no_of_nights').val(),
                    num_of_adults: $('#num_of_adults').val(),
                    num_of_child: $('#num_of_child').val(),
                    charges: $('#charges').val(),
                    discount: $('#discount').val(),
                    tax: $('#tax').val(),
                    amount: $('#amount').val(),
                    comment: $('#comment').val(),
                    _token: '{{ csrf_token() }}' // Include CSRF token for Laravel
                };

                    // AJAX request to create the booking
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('/booking/store') }}",
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            // alert('Booking created successfully');
                            if (response.success == true) {
                                // alert(response.message);
                                window.location.href = '/booking';
                            } else {
                                // $('#bookingExistModal').modal('show');
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Booking Exist',
                                    text: 'A booking already exists for this date.',
                                    // confirmButtonText: 'OK'
                                    showConfirmButton: false,
                                    timer: 2500
                                });
                            }
                        },
                        error: function(error) {
                            console.error('Error:', error);
                            // Handle errors (optional)
                        }
                    });
                }); 
            });
    </script>

@endsection
