@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <form action="{{ route('shipper.store') }}" method="POST">
            @csrf
            <div class="d-flex justify-content-between align-items-center p-3 py-0">
                <h4 class="fw-bold py-3 mb-2">
                    <a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard</a>
                    <a href="{{ url('/client-profile/' . request()->client_id) }}" class="text-muted fw-light">/ Shipment</a>
                    <span class="color">/</span>
                    <span class="text-heading fw-bold text-color"> Add</span>
                </h4>
                <div class="text-end">
                    <a href="{{ url('/client-profile/' . request()->client_id) }}" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-primary">Save & Close</button>
                </div>
            </div>
            <div class="row invoice-add">
                <div class="col-md-12">
                    <div class="card invoice-preview-card">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <h4 class="my-3">Add Shipment</h4>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <p class="mb-2">Currency</p>
                                    <select class="form-select" name="currency_id" id="currency_id">
                                        <option value="" selected disabled>Select Currency</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->id }}" data-rate="{{ $currency->rate }}">
                                                {{ $currency->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <p class="mb-2">Buy</p>
                                    <input type="number" class="form-control" name="buy" id="buy"
                                        placeholder="Buy">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <p class="mb-2">Sell</p>
                                    <input type="number" class="form-control" name="sell" id="sell"
                                        placeholder="Sell">
                                </div>
                            </div>
                            <div class="row mx-0">
                                <!-- Form fields for shipment details -->
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Client Name</p>
                                    <select id="client_id" required name="client_id" type="text"
                                        class="select2 form-select form-select-lg" data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($clients as $client)
                                            <option {{ request()->client_id == $client->id ? 'selected' : '' }}
                                                value="{{ $client->id }}">
                                                {{ $client->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Vendor Name</p>
                                    <select id="vendor_id" name="vendor_id" type="text"
                                        class="select2 form-select form-select-lg" data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}">
                                                {{ $vendor->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Date</p>
                                    <input type="date" class="form-control" name="date" placeholder="Enter Date"
                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>
                                {{-- <div class="col-md-3 mb-3">
                                    <p class="mb-2">Invoice</p>
                                    <input type="text" class="form-control" readonly name="invoice_no"
                                        placeholder="Enter Invoice number">
                                </div> --}}
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Marks / Numbers</p>
                                    <input type="text" class="form-control" name="marks_and_numbers"
                                        placeholder="Enter Marks or Numbers">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">B/L #</p>
                                    <input type="text" class="form-control" name="bl_no" placeholder="B/L #">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Vessel Voy</p>
                                    <input type="text" class="form-control" name="vessel_voy" placeholder="Vessel Voy">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Bags</p>
                                    <input type="text" class="form-control" name="bags" placeholder="Bags">
                                </div>
                                <div class="col-md-3 my-4">
                                    <div class="form-floating form-floating-outline ">
                                        <div class="select2-primary">
                                            <select data-placeholder="Select Country" id="delivery_country_id"
                                                name="delivery_country_id" class="select2 form-select-lg"
                                                data-allow-clear="true">
                                                <option value="">Select</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label for="country">Delivery Country</label>
                                    </div>
                                </div>
                                <div class="col-md-3 my-4">
                                    <div class="form-floating form-floating-outline ">
                                        <div class="select2-primary">
                                            <select data-placeholder="Select City" id="delivery_city"
                                                name="delivery_city_id" class="select2 w-full" data-allow-clear="true">
                                                <option value="">Select</option>
                                                {{-- @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                        <label for="city">Delivery City</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">FCL</p>
                                    <input type="text" class="form-control" name="fcl" placeholder="Enter FCL">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Imcont Number</p>
                                    <input type="text" class="form-control" name="imcont_no"
                                        placeholder="Imcont Number">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">EXPC #</p>
                                    <input type="text" class="form-control" name="expc_no" placeholder="EXPC Number">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="delivery_address">Delivery Address</label>
                                        <textarea class="form-control" name="delivery_address" id="delivery_address" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Loading Date</p>
                                    <input type="date" class="form-control" name="loading_date"
                                        placeholder="Enter Date">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">EwayBill / Invc #</p>
                                    <input type="text" class="form-control" name="eway_bill" placeholder="Eway Bill">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Bags</p>
                                    <input type="text" class="form-control" name="expc_bags" placeholder="Bags">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Carrying Rate</p>
                                    <input type="number" class="form-control" name="carrying_rate" id="carrying_rate"
                                        placeholder="Carrying Rate">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">V Carrying Rate</p>
                                    <input type="number" class="form-control" name="rate" id="rate"
                                        placeholder="Rate">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Qty / Weight</p>
                                    <input type="number" class="form-control" name="quantity" id="quantity"
                                        placeholder="Weight">
                                </div>
                                {{-- <div class="col-md-2 mb-3">
                                    <p class="mb-2">RTGS Amount</p>
                                    <input type="number" class="form-control" name="rtgs_amount" id="rtgs_amount"
                                        placeholder="Amount" readonly>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <p class="mb-2">Converted Amount</p>
                                    <input type="text" class="form-control converted-amount" name="converted_amount"
                                        readonly placeholder="Converted Amount">
                                </div> --}}
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Carrying Amount</p>
                                    <input type="number" class="form-control" readonly name="carrying_amount"
                                        id="carrying_amount" placeholder="Amount">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Converted Carrying Amount</p>
                                    <input type="text" class="form-control converted-carrying-amount"
                                        name="converted_carrying_amount" readonly placeholder="Converted Amount">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">V Carrying Amount</p>
                                    <input type="text" class="form-control" name="v_carrying_amount" id="bill_amount"
                                        placeholder="Amount">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Converted V Carrying Amount</p>
                                    <input type="text" class="form-control converted-bill-amount"
                                        name="converted_bill_amount" readonly placeholder="Converted Amount">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Eway Bill Amount</p>
                                    <input type="text" class="form-control" name="bill_amount" id="e_way_bill"
                                        placeholder="Amount">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">RTGS Excess</p>
                                    <input type="text" class="form-control" name="rcgs_excess" id="rcgs_excess"
                                        readonly placeholder="RTGS Excess">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Vehicle # / Driver #</p>
                                    <input type="text" class="form-control" name="vehicle_and_driver"
                                        placeholder="Vehicle Driver">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Delivery Date</p>
                                    <input type="date" class="form-control" name="delivery_date"
                                        placeholder="Enter Date">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Delivery Status</p>
                                    <select class="form-select" name="delivery_status">
                                        <option value="1">Delivered</option>
                                        <option value="2">Pending</option>
                                        <option value="0">Reject</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
<script src="{{ url('/assets/vendor/libs/jquery/jquery.js') }}"></script>

<!-- Page JS -->
<script src="{{ url('/assets/js/offcanvas-send-invoice.js') }}"></script>
<script src="{{ url('/assets/js/app-invoice-add.js') }}"></script>
<script>
    $(document).ready(function() {

        $('#delivery_country_id').change(function() {
            var countryId = $(this).val();

            if (countryId) {
                $.ajax({
                    url: '/api/get-cities/' + countryId,
                    type: 'GET',
                    success: function(data) {
                        var citiesDropdown = $('#delivery_city');
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
                $('#delivery_city').empty(); // Clear the cities dropdown
                $('#delivery_city').append(
                    '<option value="">Select City</option>'); // Add default option
            }
        });

    })
</script>
<script>
    $(document).ready(function() {
        $("#currency_id").on("change", function() {
            updateBuySell(this.value);
        });

        function updateBuySell(selectedCurrencyId) {
            // var selectedCurrencyId = this.value;
            var buyInput = document.getElementById('buy');
            var sellInput = document.getElementById('sell');
            console.log('selectedCurrencyId', selectedCurrencyId);

            if (selectedCurrencyId == '5') {
                // Set buy to 0, sell to 1, and make both fields readonly
                buyInput.value = 0;
                sellInput.value = 1;
                buyInput.setAttribute('readonly', true);
                sellInput.setAttribute('readonly', true);
                updateConvertedAmount();
            } else {
                // If a different currency is selected, remove readonly attribute
                buyInput.removeAttribute('readonly');
                sellInput.removeAttribute('readonly');
            }
        }

        // function updateConvertedAmount() {
        //     const sellInput = document.getElementById('sell');
        //     const rtgsAmountInput = document.getElementById('rtgs_amount');
        //     const convertedAmountInput = document.querySelector('.converted-amount');
        //     const rtgsAmount = parseFloat(rtgsAmountInput.value) || 0;
        //     const sell = parseFloat(sellInput.value) || 1;
        //     console.log('sell', sell)
        //     const convertedAmount = rtgsAmount * sell;
        //     convertedAmountInput.value = convertedAmount.toFixed(2);
        // }
        function updateConvertedAmount() {
            const sellInput = document.getElementById('sell');
            const carryingAmountInput = document.getElementById('carrying_amount');
            const billAmountInput = document.getElementById('bill_amount');
            const convertedCarryingAmountInput = document.querySelector('.converted-carrying-amount');
            const convertedBillAmountInput = document.querySelector('.converted-bill-amount');
            const carryingAmount = parseFloat(carryingAmountInput.value) || 0;
            const billAmount = parseFloat(billAmountInput.value) || 0;
            const sell = parseFloat(sellInput.value) || 1;
            console.log('sell', sell)
            const convertedAmount = carryingAmount * sell;
            const convertedbillAmount = billAmount * sell;
            convertedCarryingAmountInput.value = convertedAmount.toFixed(2);
            convertedBillAmountInput.value = convertedbillAmount.toFixed(2);

        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rateInput = document.getElementById('rate');
        const rateCarryingInput = document.getElementById('carrying_rate');
        const quantityInput = document.getElementById('quantity');
        const sellInput = document.getElementById('sell');
        const carryingAmountInput = document.getElementById('carrying_amount');
        const billAmountInput = document.getElementById('bill_amount');
        const currencySelect = document.getElementById('currency_id');
        const eWayBill = document.getElementById('e_way_bill');
        const convertedCarryingAmountInput = document.querySelector('.converted-carrying-amount');
        const convertedBillAmountInput = document.querySelector('.converted-bill-amount');

        function updateAmount() {
            const rate = parseFloat(rateInput.value) || 0;
            const carryingRate = parseFloat(rateCarryingInput.value) || 0;
            const quantity = parseFloat(quantityInput.value) || 1;
            const carryingAmount = carryingRate * quantity;
            const billAmount = rate * quantity;
            carryingAmountInput.value = carryingAmount.toFixed(2);
            billAmountInput.value = billAmount.toFixed(2);
            updateRCGSExcess();
            updateConvertedAmount(); // Update converted amount whenever RTGS amount changes
        }

        function updateConvertedAmount() {
            const carryingAmount = parseFloat(carryingAmountInput.value) || 0;
            const billAmount = parseFloat(billAmountInput.value) || 0;
            const sell = parseFloat(sellInput.value) || 1;
            const convertedCarryingAmount = carryingAmount * sell;
            const convertedBillAmount = billAmount * sell;
            convertedCarryingAmountInput.value = convertedCarryingAmount.toFixed(2);
            convertedBillAmountInput.value = convertedBillAmount.toFixed(2);
        }

        function updateRCGSExcess() {
            const rcgsExcessInput = document.getElementById('rcgs_excess');
            const carryingAmount = parseFloat(carryingAmountInput.value) || 0;
            const billAmount = parseFloat(eWayBill.value) || 0;
            const rcgsExcess = billAmount - carryingAmount;
            rcgsExcessInput.value = rcgsExcess.toFixed(2);
        }

        function handleRateQuantityChange() {
            updateAmount();
        }

        function handleSellChange() {
            updateConvertedAmount();
        }

        function handleCurrencyChange() {
            updateConvertedAmount();
        }

        // Event listeners
        rateInput.addEventListener('input', handleRateQuantityChange);
        rateCarryingInput.addEventListener('input', handleRateQuantityChange);
        quantityInput.addEventListener('input', handleRateQuantityChange);
        sellInput.addEventListener('input', handleSellChange);
        currencySelect.addEventListener('change', handleCurrencyChange);

        // Initial calculation if values are prefilled
        updateAmount();
        updateConvertedAmount();

        $('input[name="carrying_amount"], input[name="bill_amount"]').on('input',
            function() {
                updateConvertedAmount();
                updateRCGSExcess();
            });

        $('input[name="rate"], input[name="carrying_rate"]').on('input', function() {
            updateAmount();
        });

    });
</script>
