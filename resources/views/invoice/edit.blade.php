@extends('layout.master')
@section('content')
    <div class="container-xxl flex-grow-1  container-p-y">
        <form id="invoiceForm" action="{{ url('/invoice/edit/' . $transaction->id) }}" method="POST">
            @csrf
            <input type="hidden" name="status" id="invoiceStatus" value="">
            <div class="d-flex justify-content-between align-items-center p-3 py-0">
                <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a>
                </h4>
                <div class="text-end">
                    {{-- <button type="button" value="2" class="close-invoice btn btn-primary">
                        Save & Close
                    </button> --}}
                    <button type="submit" class="save-invoice btn btn-primary">
                        Save
                    </button>
                </div>
                {{-- <button class="btn btn-secondary create-new btn-primary" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" tabindex="0"
                aria-controls="DataTables_Table_0" type="button"><span><i class="mdi mdi-filter-outline me-sm-1"></i>
                    <span class="d-none d-sm-inline-block">Filters</span></span></button> --}}
            </div>
            <div class="row invoice-add">
                <!-- Invoice Add-->
                <div class="col-md-12">
                    <div class="card invoice-preview-card">
                        <div class="card-body pb-0">
                            <div class="row mx-0">
                                <div class="col-md-7 mb-md-0 mb-4 ps-0">
                                    <div class=" svg-illustration align-items-center gap-2">
                                        <img src="{{ url('/pak_euro.png') }}" width="120px"
                                            class="h4 mb-0  app-brand-text fw-bold">
                                    </div>
                                    {{-- <h4 class="mb-0">Create Invoice</h4> --}}

                                </div>
                                <div class="col-md-5 pe-0 ps-0 ps-md-2">
                                    <dl class="row mb-2 g-2">
                                        <dt class="col-sm-6 mb-2 d-md-flex align-items-center justify-content-end">
                                            <span
                                                class="h4 text-capitalize mb-0 text-nowrap">{{ $transaction->type_id == 1 ? 'Invoice' : 'Bill' }}</span>
                                        </dt>
                                        <dd class="col-sm-6">
                                            <div class="input-group input-group-merge disabled">
                                                <span class="input-group-text">#</span>
                                                <input type="text" class="form-control" disabled
                                                    placeholder="Invoice No.#" value="{{ $transaction->tran_no }}"
                                                    id="invoiceId" />
                                            </div>
                                        </dd>
                                        <dt class="col-sm-6 mb-2 d-md-flex align-items-center justify-content-end">
                                            <span class="fw-normal">Date:</span>
                                        </dt>
                                        <dd class="col-sm-6">
                                            <input type="text" name="date" id="bs-datepicker-format"
                                                class="form-control" placeholder="DD/MM/YYYY"
                                                aria-describedby="basic-icon-default-phone2"
                                                value="{{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y') }}" />
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
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
                                </div>
                                <div class="col-md-2 mb-md-0 my-3">
                                    <div class="form-floating form-floating-outline ">
                                        <div class="select2-primary">
                                            <select id="customer_type_id" name="customer_type_id" type="text"
                                                class="select2 form-select form-select-lg" data-allow-clear="true">
                                                <option value="">Select</option>
                                                @foreach ($customer_types as $type)
                                                    <option value="{{ $type->id }}">
                                                        {{ $type->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label for="customer_type">Customer Type</label>
                                    </div>
                                </div> --}}
                                <div class="col-md-3 mb-md-0 my-3">
                                    <div class="form-floating form-floating-outline">
                                        <select id="customer_id" required name="client_id" type="text"
                                            class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value="">Select</option>
                                            @foreach ($clients as $client)
                                                <option {{ $transaction->client_id == $client->id ? 'selected' : '' }}
                                                    value="{{ $client->id }}">
                                                    {{ $client->name }} </option>
                                            @endforeach
                                        </select>
                                        <label for="salesperson">Client Name</label>
                                    </div>
                                </div>
                                <div class="col-md-3 offset-md-2 mb-md-0 my-3">
                                    <div class="form-floating form-floating-outline">
                                        <select id="currency_id" name="currency_id" type="text"
                                            class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value=""></option>
                                            @foreach ($currencies as $currency)
                                                <option {{ $transaction->currency_id == $currency->id ? 'selected' : '' }}
                                                    value="{{ $currency->id }}">
                                                    {{ @$currency->name }} </option>
                                            @endforeach
                                        </select>
                                        <label for="currency">Currency</label>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <p class="mb-2">Buy</p>
                                    <input type="number" value="{{ $transaction->buy }}" class="form-control"
                                        name="buy" id="buy" placeholder="Buy">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <p class="mb-2">Sell</p>
                                    <input type="number" value="{{ $transaction->sell }}" class="form-control"
                                        name="sell" id="sell" placeholder="Sell">
                                </div>

                            </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body pt-0">
                            <div class="source-item pt-1">
                                <div class="mb-3" data-repeater-list="group">
                                    @foreach ($transaction->transaction_detail as $index => $item)
                                        <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item>
                                            <div class="d-flex rounded position-relative pe-0">
                                                <div class="row w-100 p-2">
                                                    {{-- <div class="col-md-2 mb-md-0 mb-3">
                                                    <p class="mb-2 ">Product Categories</p>
                                                    <select class="product-category-dropdown form-select" required
                                                        name="product_category_id" type="text">
                                                        <option value="">Select</option>
                                                        @foreach ($product_categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}

                                                    <div class="col-md-2 mb-md-0 mb-3">
                                                        <p class="mb-2 ">Charges</p>
                                                        <select class="charge-dropdown form-select" name="charge_id"
                                                            type="text">
                                                            @foreach ($charges as $charge)
                                                                <option
                                                                    {{ @$item->charge_id == $charge->id ? 'selected' : '' }}
                                                                    value="{{ $charge->id }}">{{ $charge->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 mb-md-0 mb-3">
                                                        <div class="form-group">
                                                            <p class="mb-2 repeater-title">Description</p>
                                                            <textarea class="form-control form-control-sm" name="description" rows="1">{{ @$item->description }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 mb-md-0 mb-3">
                                                        <p class="mb-2 repeater-title">Rate</p>
                                                        <input type="text" class="form-control rate" name="rate"
                                                            required id="rate" placeholder="Rate"
                                                            value="{{ (int) @$item->rate }}" />
                                                    </div>
                                                    <div class="col-md-1 mb-md-0 mb-3">
                                                        <p class="mb-2 repeater-title">Weight</p>
                                                        <input type="text" min="1" max="99999"
                                                            class="form-control invoice-item-qty quantity" name="quantity"
                                                            id="quantity" value="{{ @$item->quantity }}"
                                                            placeholder="Qty" />
                                                    </div>
                                                    <div class="col-md-2 mb-md-0 mb-3">
                                                        <p class="mb-2 repeater-title">Amount</p>
                                                        <input type="text" class="form-control amount" name="amount"
                                                            required placeholder="Amount" value="{{ @$item->amount }}" />
                                                    </div>
                                                    <div class="col-md-2 mb-md-0 mb-3">
                                                        <p class="mb-2 repeater-title">Converted Amount</p>
                                                        <input type="text" class="form-control converted-amount"
                                                            name="converted_amount"
                                                            value="{{ @$item->converted_amount }}" readonly
                                                            placeholder="Converted Amount" />
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary" data-repeater-create>
                                            <i class="mdi mdi-plus me-1"></i> Add Item
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-0" />
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 d-flex justify-content-start">
                                    <div class="invoice-calculations">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="w-px-200">Payment :</span>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <select id="type_id" name="type_id" type="text"
                                                        class="select2 form-select form-select-lg"
                                                        data-allow-clear="true">
                                                        <option value="">Select</option>
                                                        @foreach ($types as $type)
                                                            <option value="{{ $type->id }}">
                                                                {{ $type->name }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="number" name="payment" class="form-control"
                                                        id="payment" placeholder="Amount" />
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        {{-- @if ($totalAmountRemaining != 0) --}}
                                        <div class="d-flex justify-content-between align-items-center mb-2 due-section">
                                            <span>Due:</span>
                                            <input type="hidden" class="due_amount" name="due_amount"
                                                value="{{ $totalAmountRemaining }}">
                                            <div class="col-md-6">
                                                <span class="fw-semibold" id="due_amount">
                                                    {{ number_format($totalAmountRemaining, 2, '.', '') }}
                                                </span>
                                            </div>
                                        </div>
                                        {{-- @elseif ($advanceAmount != 0) --}}
                                        <div
                                            class="d-flex justify-content-between align-items-center mb-2 advance-section">
                                            <span>Advance:</span>
                                            <input type="hidden" class="advance_amount" name="advance_amount"
                                                value="{{ $advanceAmount }}">
                                            <div class="col-md-6">
                                                <span class="fw-semibold" id="advance_amount">
                                                    {{ number_format($advanceAmount, 2, '.', '') }}
                                                </span>
                                            </div>
                                        </div>
                                        {{-- @endif --}}
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex justify-content-md-end">
                                    <div class="invoice-calculations">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="w-px-100">Sub Total:</span>
                                            <input type="hidden" class="sub_total" name="sub_total"
                                                value="{{ $transaction->amount }}">
                                            <span class="fw-semibold sub_total" id="sub_total">
                                                {{ $transaction->amount }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="w-px-100">Discount :</span>
                                            <span class="fw-semibold d-flex">
                                                <input type="text" name="total_discount_percentage"
                                                    class="form-control w-px-100 me-2" id="total_discount_percentage"
                                                    placeholder="%"
                                                    value="{{ $transaction->total_discount_percentage }}" />
                                                <input type="text" name="total_discount_amount"
                                                    class="form-control w-px-100" id="total_discount_amount"
                                                    placeholder="$" value="{{ $transaction->total_discount_amount }}" />
                                            </span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="w-px-100">Tax :</span>
                                            <span class="fw-semibold d-flex">
                                                <input type="text" name="total_tax_percentage"
                                                    class="form-control w-px-100 me-2" id="total_tax_percentage"
                                                    placeholder="%" value="{{ $transaction->total_tax_percentage }}" />
                                                <input type="text" name="total_tax_amount"
                                                    class="form-control w-px-100" id="total_tax_amount" placeholder="$"
                                                    value="{{ $transaction->total_tax_amount }}" />
                                            </span>
                                        </div>
                                        <hr />
                                        <div class="d-flex justify-content-between">
                                            <span class="w-px-100">Total:</span>
                                            <input type="hidden" class="total_amount" name="total_amount"
                                                value=" {{ $transaction->total_amount }}">
                                            <span class="fw-semibold" id="total_amount">
                                                {{ $transaction->total_amount }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="w-px-300">Total Converted Amount:</span>
                                            <input type="hidden" class="total_amount_converted"
                                                value="{{ $transaction->total_converted_amount }}"
                                                name="total_converted_amount">
                                            <span class="fw-semibold" id="total_amount_converted">
                                                {{ @$transaction->currency->name }}
                                                {{ @$transaction->total_converted_amount }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-datatable table-responsive mt-3 p-3">
                        <table class="datatables-basic table table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        <h6>Date</h6>
                                    </th>
                                    <th>
                                        <h6>Amount Received / Paid</h6>
                                    </th>
                                    {{-- <th>
                                        <h6>Remaining Amount</h6>
                                    </th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (@$transaction->payments as $payment)
                                    <tr>
                                        <td>{{ $payment->created_at }}</td>
                                        <td>{{ number_format((int) $payment->amount_paid, 2, '.', '') }}</td>
                                        {{-- <td>{{ number_format($payment->remaining_amount, 2, '.', '') }}</td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--/ Content -->
@endsection
<script src="{{ url('/assets/vendor/libs/jquery/jquery.js') }}"></script>

<!-- Page JS -->
<script src="{{ url('/assets/js/offcanvas-send-invoice.js') }}"></script>
<script src="{{ url('/assets/js/app-invoice-add.js') }}"></script>


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
                updateAmounts();
            } else {
                // If a different currency is selected, remove readonly attribute
                buyInput.removeAttribute('readonly');
                sellInput.removeAttribute('readonly');
            }
        }

        function updateAmounts() {
            let totalAmount = 0;
            let totalConvertedAmount = 0;

            // Calculate item amounts and converted amounts
            $('[data-repeater-item]').each(function() {
                let $item = $(this);
                let rate = parseFloat($item.find('.rate').val()) || 0;
                let quantity = parseFloat($item.find('.quantity').val()) || 1;
                let amount = rate * quantity;
                let sell = parseFloat($('#sell').val()) || 0;
                let convertedAmount = sell * amount;

                $item.find('.amount').val(amount.toFixed(2));
                $item.find('.converted-amount').val(convertedAmount.toFixed(2));

                totalAmount += amount;
                totalConvertedAmount += convertedAmount;
            });

            // Update sub-total
            $('#sub_total').text(`${totalAmount.toFixed(2)}`);
            $('.sub_total').val(totalAmount.toFixed(2));

            // Recalculate discount and tax
            calculateDiscountAndTax(totalAmount);
        }

        function calculateDiscountAndTax(subTotal) {
            // console.log(subTotal);
            let discountPercentage = parseFloat($('#total_discount_percentage').val()) || 0;
            let discountAmount = parseFloat($('#total_discount_amount').val()) || 0;
            let taxPercentage = parseFloat($('#total_tax_percentage').val()) || 0;
            let taxAmount = parseFloat($('#total_tax_amount').val()) || 0;

            var totalAmount = subTotal;

            if (!isNaN(discountPercentage)) {

                var discountedAmount = (discountPercentage / 100) *
                    parseInt($('#sub_total').val());
                $("#total_discount_amount").val(discountedAmount.toFixed(2));

                totalAmount -= (discountPercentage / 100) * subTotal;
            } else if (!isNaN(discountAmount)) {

                var discountedPercentage = (discountAmount / parseInt($('#sub_total').val())) * 100;
                $("#total_discount_percentage").val(discountedPercentage.toFixed(0));

                totalAmount -= discountAmount;
            }

            if (!isNaN(taxPercentage)) {

                var taxedAmount = (taxPercentage / 100) *
                    parseInt($('#sub_total').val());
                $("#total_tax_amount").val(taxedAmount.toFixed(2));

                totalAmount += (taxPercentage / 100) * subTotal;
            } else if (!isNaN(taxAmount)) {

                var taxedPercentage = (taxAmount / parseInt($('#sub_total').val())) * 100;
                $("#total_tax_percentage").val(taxedPercentage.toFixed(0));

                totalAmount += taxAmount;
            }

            let sell = parseFloat($('#sell').val()) || 0;

            var totalConvertedAmount = totalAmount * sell;

            $('#total_amount').text(`${totalAmount.toFixed(2)}`);
            $('.total_amount').val(totalAmount.toFixed(2));
            $('#total_amount_converted').text(totalConvertedAmount.toFixed(2));
            $('.total_amount_converted').val(totalConvertedAmount.toFixed(2));

        }

        $("#total_discount_percentage").on("input", function() {
            var discountPercentage = parseFloat($('#total_discount_percentage').val());
            var subTotal = parseInt($('#sub_total').val());

            // console.log(discountPercentage);
            if (!isNaN(discountPercentage)) {
                var discountAmount = (discountPercentage / 100) *
                    parseInt($('#sub_total').val()); // Replace 1000 with your desired base amount
                // console.log(discountAmount);
                $("#total_discount_amount").val(discountAmount.toFixed(2));
                // var final_amount = discountAmount;
                // console.log(discountAmount)
            } else {
                $("#total_discount_amount").val("");
            }
            calculateDiscountAndTax(subTotal);
        });

        $("#total_discount_amount").on("input", function() {
            var discountAmount = parseFloat($(this).val());
            var subTotal = parseInt($('#sub_total').val());


            if (!isNaN(discountAmount)) {
                // Percentage formula = (Value/Total value) × 100
                var discountPercentage = (discountAmount / parseInt($('#sub_total').val())) * 100;
                $("#total_discount_percentage").val(discountPercentage.toFixed(0));
            } else {
                $("#total_discount_percentage").val("");
            }
            calculateDiscountAndTax(subTotal);

        });
        $("#total_tax_percentage").on("input", function() {
            var taxPercentage = parseFloat($('#total_tax_percentage').val());
            var subTotal = parseInt($('#sub_total').val());

            // console.log(discountPercentage);
            if (!isNaN(taxPercentage)) {
                var taxAmount = (taxPercentage / 100) *
                    parseInt($('#sub_total').val()); // Replace 1000 with your desired base amount
                // console.log(discountAmount);
                $("#total_tax_amount").val(taxAmount.toFixed(2));
                // var final_amount = discountAmount;
                // console.log(discountAmount)
            } else {
                $("#total_tax_amount").val("");
            }
            calculateDiscountAndTax(subTotal);
        });

        $("#total_tax_amount").on("input", function() {
            var taxAmount = parseFloat($(this).val());
            var subTotal = parseInt($('#sub_total').val());


            if (!isNaN(taxAmount)) {
                // Percentage formula = (Value/Total value) × 100
                var taxPercentage = (taxAmount / parseInt($('#sub_total').val())) * 100;
                $("#total_tax_percentage").val(taxPercentage.toFixed(0));
            } else {
                $("#total_tax_percentage").val("");
            }
            calculateDiscountAndTax(subTotal);

        });

        // Event listeners for real-time updates
        $(document).on('input', '.rate, .quantity, #sell', function() {
            updateAmounts();
        });

        $(document).on('input',
            '#total_discount_percentage, #total_discount_amount, #total_tax_percentage, #total_tax_amount',
            function() {
                let subTotal = parseFloat($('.sub_total').val()) || 0;
                calculateDiscountAndTax(subTotal);
            });

        // Recalculate amounts when a new item is added or removed
        $(document).on('click', '[data-repeater-create], [data-repeater-delete]', function() {
            updateAmounts();
        });

        function getProductId(select) {
            var selectedProcedure = select.options[select.selectedIndex].value;
            console.log(selectedProcedure);
            var repeaterWrapper = $(select).closest('.repeater-wrapper');

            $.ajax({
                type: "POST",
                data: {
                    "charge_id": selectedProcedure,
                },
                url: "{{ url('api/charge/getById') }}",
                dataType: 'json',
                success: function(result) {
                    var data = result.data;
                    console.log(data);
                    var totalAmount = data.price;
                    repeaterWrapper.find(".rate").val(data.price ?? null);
                    updateAmounts();
                }
            });
        }

        // Attach event handler to all procedure dropdowns
        $(document).on('change', '.charge-dropdown', function() {
            getProductId(this);
        });
        function updatePaymentDetails() {
            // Get the total amount
            var totalAmount = parseFloat($(".total_amount").val()) || 0;
            var paidAmount = parseFloat("{{ $totalAmountPaid }}") || 0;
            var typeId = parseInt($("#type_id").val()) || 0;

            // Get the entered payment amount
            var paymentAmount = parseFloat($("#payment").val()) || 0;

            var difference, dueAmount, advanceAmount;

            if (typeId === 1) { // Receipt
                difference = paidAmount + paymentAmount - totalAmount ;
                advanceAmount = difference > 0 ? difference : 0;
                dueAmount = difference < 0 ? Math.abs(difference) : 0;
            } else if (typeId === 2) { // Payment
                difference = (paidAmount - totalAmount) - paymentAmount;
                dueAmount = difference < 0 ? difference : 0;
                advanceAmount = difference > 0 ? difference : 0;
            } else {
                console.error("Invalid type_id");
                return;
            }

            console.log("Due Amount:", dueAmount);
            console.log("Advance Amount:", advanceAmount);

            // Update the UI with the calculated values
            $(".due_amount").val(dueAmount.toFixed(2));
            $("#due_amount").text(dueAmount.toFixed(2));

            $(".advance_amount").val(advanceAmount.toFixed(2));
            $("#advance_amount").text(advanceAmount.toFixed(2));

            // Show or hide the relevant sections
            if (dueAmount > 0) {
                $(".due-section").show();
                $(".advance-section").hide();
            } else if (advanceAmount > 0) {
                $(".advance-section").show();
                $(".due-section").hide();
            } else {
                $(".due-section").hide();
                $(".advance-section").hide();
            }
        }

        $("#payment").on("input", updatePaymentDetails);
        $("#type_id").on("change", updatePaymentDetails);


        // Initial calculation on page load
        // updateAmounts();
    });







    // $(document).ready(function() {
    //     function calculateAmounts() {
    //         var totalAmount = 0;
    //         var totalConvertedAmount = 0;

    //         // Calculate the subtotal for each item
    //         $('[data-repeater-item]').each(function() {
    //             var row = $(this);
    //             var rate = parseFloat(row.find('.rate').val()) || 0;
    //             var quantity = parseFloat(row.find('.quantity').val()) || 0;
    //             var sellRate = parseFloat($('#sell').val()) || 1;

    //             // Calculate amount and converted amount
    //             var amount = rate * quantity;
    //             row.find('.amount').val(amount.toFixed(2));

    //             var convertedAmount = amount * sellRate;
    //             row.find('.converted-amount').val(convertedAmount.toFixed(2));

    //             totalAmount += amount;
    //             totalConvertedAmount += convertedAmount;
    //         });

    //         // Update subtotal
    //         $('#sub_total').text('$ ' + totalAmount.toFixed(2));
    //         $('input[name="sub_total"]').val(totalAmount.toFixed(2));

    //         // Update total converted amount
    //         $('#total_amount_converted').text('$ ' + totalConvertedAmount.toFixed(2));
    //         $('input[name="total_amount_converted"]').val(totalConvertedAmount.toFixed(2));

    //         // Update totals (discount and tax)
    //         updateTotals();
    //     }

    //     function updateTotals() {
    //         var subTotal = parseFloat($('#sub_total').text().replace('$ ', '')) || 0;
    //         var discountPercentage = parseFloat($('#total_discount_percentage').val()) || 0;
    //         var discountAmount = parseFloat($('#total_discount_amount').val()) || 0;
    //         var taxPercentage = parseFloat($('#total_tax_percentage').val()) || 0;
    //         var taxAmount = parseFloat($('#total_tax_amount').val()) || 0;

    //         // Calculate total discount amount
    //         var discountAmountCalculated = (subTotal * discountPercentage / 100) + discountAmount;

    //         // Calculate total after discount
    //         var totalAfterDiscount = subTotal - discountAmountCalculated;

    //         // Calculate total tax amount
    //         var taxAmountCalculated = (totalAfterDiscount * taxPercentage / 100) + taxAmount;

    //         // Calculate final total
    //         var finalTotal = totalAfterDiscount + taxAmountCalculated;

    //         // Update discount and tax fields
    //         $('#total_discount_amount').val(discountAmountCalculated.toFixed(2));
    //         $('#total_tax_amount').val(taxAmountCalculated.toFixed(2));

    //         // Update final total
    //         $('#total_amount').text('$ ' + finalTotal.toFixed(2));
    //         $('input[name="total_amount"]').val(finalTotal.toFixed(2));
    //     }

    //     // Recalculate amounts when input fields change
    //     $('body').on('input', '#sell, .rate, .quantity', function() {
    //         calculateAmounts();
    //     });

    //     $('body').on('input', '#total_discount_percentage, #total_discount_amount, #total_tax_percentage, #total_tax_amount', function() {
    //         updateTotals(); // Ensure the totals are recalculated with updated discount and tax values
    //     });

    //     // Handle dynamic changes like item removal
    //     $('body').on('click', '[data-repeater-delete]', function() {
    //         setTimeout(calculateAmounts, 0); // Delay to ensure the item is fully removed
    //     });

    //     // Initialize calculations on page load
    //     calculateAmounts();
    // });
</script>
