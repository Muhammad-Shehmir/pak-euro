@extends('layout.master')
@section('content')
    <div class="container-xxl flex-grow-1  container-p-y">
        <form id="invoiceForm" action="{{ url('/invoice/add') }}" method="POST">
            @csrf
            <input type="hidden" name="status" id="invoiceStatus" value="">
            <div class="d-flex justify-content-between align-items-center p-3 py-0">
                <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a
                        href="{{ url('/invoice') }}" class="text-muted fw-light">/ Invoice</a><span class="color">
                        /</span><span class="text-heading fw-bold text-color"> Add</span>
                </h4>
                <div class="text-end">
                    <button type="button" value="2" class="close-invoice btn btn-primary">
                        Save & Close
                    </button>
                    <button type="button" value="1" class="save-invoice btn btn-primary">
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
                                        <img src="{{ url('/pak_euro.png') }}" width="100px"
                                            class="h4 mb-0  app-brand-text fw-bold">
                                    </div>
                                    {{-- <h4 class="mb-0">Create Invoice</h4> --}}

                                </div>
                                <div class="col-md-5 pe-0 ps-0 ps-md-2">
                                    <dl class="row mb-2 g-2">
                                        <dt class="col-sm-6 mb-2 d-md-flex align-items-center justify-content-end">
                                            <span class="h4 text-capitalize mb-0 text-nowrap">Invoice</span>
                                        </dt>
                                        <dd class="col-sm-6">
                                            <div class="input-group input-group-merge disabled">
                                                <span class="input-group-text">#</span>
                                                <input type="text" class="form-control" disabled
                                                    placeholder="Invoice No.#"
                                                    value="{{ $invoiceNo ? (int) $invoiceNo->id + 1 : 1 }}"
                                                    id="invoiceId" />
                                            </div>
                                        </dd>
                                        {{-- <dt class="col-sm-6 mb-2 d-md-flex align-items-center justify-content-end">
                                            <span class="fw-normal">Date:</span>
                                        </dt>
                                        <dd class="col-sm-6">
                                            <input type="text" class="form-control" name="date"
                                                id="bs-datepicker-format" placeholder="DD/MM/YYYY"
                                                value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}" />

                                        </dd> --}}
                                        <dt class="col-sm-6 mb-2 d-md-flex align-items-center justify-content-end">
                                            <span class="fw-normal">Date:</span>
                                        </dt>
                                        <dd class="col-sm-6">
                                            <input type="text" name="date" id="bs-datepicker-format"
                                                class="form-control" placeholder="DD/MM/YYYY"
                                                aria-describedby="basic-icon-default-phone2"
                                                value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}" />

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
                                        <select id="customer_id" required name="customer_id" type="text"
                                            class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value="">Select</option>
                                            @foreach ($customers as $customer)
                                                <option {{ request()->customer_id == $customer->id ? 'selected' : '' }}
                                                    value="{{ $customer->id }}">
                                                    {{ $customer->name }} </option>
                                            @endforeach
                                        </select>
                                        <label for="salesperson">Customer Name</label>
                                    </div>
                                </div>
                                <div class="col-md-3 offset-md-2 mb-md-0 my-3">
                                    <div class="form-floating form-floating-outline">
                                        <select id="currency_id" required name="currency_id" type="text"
                                            class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value=""> </option>
                                            @foreach ($currencies as $currency)
                                                <option value="{{ $currency->id }}">
                                                    {{ $currency->name }} </option>
                                            @endforeach
                                        </select>
                                        <label for="currency">Currency</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating form-floating-outline">
                                        <div class="input-group input-group-merge my-3">
                                            <span class="input-group-text"><i class="mdi mdi-currency-usd"></i></span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="conversion_rate" name="buy"
                                                    id="basic-icon-default-email" class="form-control"
                                                    placeholder="Enter Buy Price" aria-label="Enter Buy Price"
                                                    aria-describedby="basic-icon-default-email2" />
                                                <label for="basic-icon-default-email">Buy</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group input-group-merge my-3">
                                        <span class="input-group-text"><i class="mdi mdi-currency-usd"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="conversion_rate" name="conversion_rate"
                                                id="basic-icon-default-email" class="form-control"
                                                placeholder="Enter Conversion Rate" aria-label="Enter Conversion Rate"
                                                aria-describedby="basic-icon-default-email2" />
                                            <label for="basic-icon-default-email">Sell</label>
                                        </div>
                                    </div>
                                   
                                </div>
                               
                            </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body pt-0">
                            <div class="source-item pt-1">
                                <div class="mb-3" data-repeater-list="group">
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
                                                <div class="col-md-4 mb-md-0 mb-3">
                                                    <p class="mb-2 ">Charges</p>
                                                    <select class="product-dropdown form-select" required
                                                        name="product_id" type="text">
                                                        <option value="">Select</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}">{{ $product->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-1 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">Rate</p>
                                                    <input type="text" class="form-control charges" name="charges"
                                                        required id="charges" placeholder="Enter Charges" />
                                                </div>
                                                <div class="col-md-1 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">Quantity</p>
                                                    <input type="text" min="1" max="99999"
                                                        class="form-control invoice-item-qty personsrooms"
                                                        name="persons_rooms" id="persons_rooms"
                                                        placeholder="quantity" />
                                                </div>
                                                <div class="col-md-2 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">Amount</p>
                                                    <input type="text" class="form-control amount" name="amount"
                                                        required placeholder="Enter Amount" />
                                                </div>
                                                <div class="col-md-4 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">Converted Amount</p>
                                                    <input type="text" class="form-control converted-amount"
                                                        name="converted_amount" readonly placeholder="Converted Amount" />
                                                </div>
                                               
                                               
                                                {{-- <div class="col-md-2 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">Days / Dives</p>
                                                    <input type="text" min="1" max="99999"
                                                        class="form-control invoice-item-qty quantity days_dives"
                                                        name="days_dives" id="days_dives" placeholder="Days / Dives" />
                                                </div> --}}
                                               
                                              
                                                {{-- <div class="col-md-2 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">Quantity</p>
                                                    <input type="text" min="1" max="99999"
                                                        class="form-control invoice-item-qty quantity" name="quantity"
                                                        id="quantity" placeholder="Qty" />
                                                </div> --}}

                                              
                                            </div>
                                            <div
                                                class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                                                <i class="mdi mdi-close cursor-pointer" data-repeater-delete></i>
                                                <div class="dropdown">
                                                    <i class="mdi mdi-cog-outline cursor-pointer more-options-dropdown"
                                                        role="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                        data-bs-auto-close="outside" aria-expanded="false">
                                                    </i>
                                                    <div class="dropdown-menu dropdown-menu-end w-px-300 p-3"
                                                        aria-labelledby="dropdownMenuButton">
                                                        <div class="row g-3">
                                                            <div class="col-md-12 mb-md-0 mb-3">
                                                                <p class="mb-2 repeater-title">Discount</p>
                                                                <input type="text" id="discount" name="discount"
                                                                    class="form-control discount invoice-item-qty"
                                                                    placeholder="%" />
                                                            </div>
                                                            <div class="col-md-12  mb-md-0 mb-3">
                                                                <p class="mb-2 repeater-title">Tax</p>
                                                                <input type="text" id="tax" name="tax"
                                                                    class="form-control tax invoice-item-qty"
                                                                    placeholder="%" />
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-divider my-3"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                               {{--  <div class="col-md-6 d-flex justify-content-start">
                                    <div class="invoice-calculations">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="me-3">Payment :</span>
                                            <div class="row">
                                                <div class="col-md-6 pe-0">
                                                    <select name="payment_mode" class="select2 form-select"
                                                        id="payment_mode">
                                                        <option value="Cash">Cash</option>
                                                        <option value="Online Transfer">Online Transfer</option>
                                                        <option value="Card">Credit Card</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" required name="payment" class="form-control"
                                                        id="payment" placeholder="$" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="card_charges">
                                            <div class="col-md-6">
                                                <span class="me-3">Card Charges :</span>
                                                <input type="text" name="credit_card_input" class="form-control"
                                                    id="credit_card_input" placeholder="$" />
                                            </div>
                                            <div class="col-md-6">
                                                <span class="me-3">Total Amount to Pay :</span>
                                                <input type="text" name="total_amount_paid" class="form-control"
                                                    id="total_amount_paid" placeholder="$" />
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="d-flex justify-content-between">
                                            <span class="w-px-100">Due:</span>
                                            <input type="hidden" class="due_amount" name="due_amount">
                                            <span class="fw-semibold" id="due_amount">$ 00.00</span>
                                        </div>
                                        {{-- <div class="d-flex justify-content-between">
                                            <span class="w-px-100">Advance:</span>
                                            <input type="hidden" class="advance_amount" name="advance_amount">
                                            <span class="fw-semibold" id="advance_amount">$ 00.00</span>
                                        </div> 
                                    </div>
                                </div>--}}
                                <div class="col-md-12 d-flex justify-content-md-end">
                                    <div class="invoice-calculations">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="w-px-100">Sub Total:</span>
                                            <input type="hidden" class="sub_total" name="sub_total">
                                            <span class="fw-semibold sub_total" id="sub_total">$ 00.00</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="w-px-100">Discount :</span>
                                            <span class="fw-semibold d-flex">
                                                <input type="text" name="total_discount_percentage"
                                                    class="form-control w-px-100 me-2" id="total_discount_percentage"
                                                    placeholder="%" />
                                                <input type="text" name="total_discount_amount"
                                                    class="form-control w-px-100" id="total_discount_amount"
                                                    placeholder="$" />
                                            </span>
                                        </div>
                                        {{-- <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="w-px-100">Service Charge :</span>
                                            <span class="fw-semibold d-flex">
                                                <input type="number" name="total_service_charge"
                                                    class="form-control w-px-100 me-2" id="total_service_charge"
                                                    value="10" placeholder="%" />
                                                <input type="text" name="total_service_charge_amount"
                                                    class="form-control w-px-100" id="total_service_charge_amount"
                                                    placeholder="$" />
                                            </span>
                                        </div> --}}
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="w-px-100">GST :</span>
                                            <span class="fw-semibold d-flex">
                                                <input type="number" name="total_tax_percentage"
                                                    class="form-control w-px-100 me-2" id="total_tax_percentage"
                                                    value="16" placeholder="%" />
                                                <input type="text" name="total_tax_amount"
                                                    class="form-control w-px-100" id="total_tax_amount"
                                                    placeholder="$" />
                                            </span>
                                        </div> 
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="w-px-100">Tax :</span>
                                            <span class="fw-semibold d-flex">
                                                <input type="number" name="total_green_tax_percentage"
                                                    class="form-control w-px-100 me-2" id="total_green_tax_percentage"
                                                    placeholder="%" />
                                                <input type="text" name="total_green_tax_amount"
                                                    class="form-control w-px-100" id="total_green_tax_amount"
                                                    placeholder="$" />
                                            </span>
                                        </div>
                                        <hr />
                                        <div class="d-flex justify-content-between">
                                            <span class="w-px-100">Total:</span>
                                            <input type="hidden" class="total_amount" name="total_amount">
                                            <span class="fw-semibold" id="total_amount">$ 00.00</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="w-px-300">Total Converted Amount:</span>
                                            <input type="hidden" class="total_amount_converted"
                                                name="total_amount_converted">
                                            <span class="fw-semibold" id="total_amount_converted"> 00.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        $('#bs-datepicker-format').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });
        // Array to store information about each procedure
        var procedures = [];

        // Listen for changes in the input fields
        $(document).on("change", ".product-dropdown, .charges, .quantity, .personsrooms, .discount, .tax",
            calculateTotalAmount);
        $(document).on("input", ".charges, .discount, .tax, .quantity, .personsrooms",
            calculateTotalAmount);

        // $(document).on("change",
        //     "#total_discount_percentage, #total_tax_percentage, #total_discount_amount, #total_tax_amount",
        //     calculateTotalBill);

        function calculateTotalAmount() {
            var totalAmount = 0;
            var totalConvertedAmount = 0;
            var currency = $('#currency_id option:selected').text() || '$';
            var ConversionRate = parseFloat($('#conversion_rate').val()) || 1;



            // Calculate total amount for each procedure
            $(".product-dropdown").each(function() {
                var repeaterWrapper = $(this).closest('.repeater-wrapper');
                var charges = parseFloat(repeaterWrapper.find(".charges").val()) || 0;
                // var quantity = parseFloat(repeaterWrapper.find(".quantity").val()) || 0;
                var days_dives = parseFloat(repeaterWrapper.find(".days_dives").val()) || 0;
                var discountPercentage = parseFloat(repeaterWrapper.find(".discount").val()) || 0;
                var taxPercentage = parseFloat(repeaterWrapper.find(".tax").val()) || 0;
                var discountAmount = (discountPercentage / 100) * charges;
                var taxAmount = (taxPercentage / 100) * charges;

                // var totalProcedureAmount = quantity * charges - discountAmount + taxAmount;
                // var totalProcedureConvertedAmount = totalProcedureAmount * ConversionRate;

                var rateAmount = 1;
                if (days_dives == 1) {
                    rateAmount = charges;
                } else if (days_dives > 1) {
                    rateAmount = days_dives * charges;
                } else if (days_dives < 1) {
                    rateAmount = 0;
                }

                var totalProcedureAmount = rateAmount - discountAmount +
                    taxAmount;
                var totalProcedureConvertedAmount = totalProcedureAmount * ConversionRate;

                // Update the amount field for the current procedure
                repeaterWrapper.find(".amount").val(totalProcedureAmount.toFixed(2));
                repeaterWrapper.find(".converted-amount").val(totalProcedureConvertedAmount.toFixed(2));

                // Add the current procedure amount to the total
                totalAmount += totalProcedureAmount;
                totalConvertedAmount += totalProcedureConvertedAmount;
            });
            // Update the total amount field or perform other actions with the total
            $(".sub_total").val(totalConvertedAmount.toFixed(2));
            $("#sub_total").text(currency + totalConvertedAmount.toFixed(2));
            $(".total_amount").val(totalAmount.toFixed(2));
            $("#total_amount").text("$ " + totalAmount.toFixed(2));
            $(".total_amount_converted").val(totalConvertedAmount.toFixed(2));
            $("#total_amount_converted").text(currency + totalConvertedAmount.toFixed(2));
            calculateTax();
            calculateServiceCharges();
            updateFinalAmount();
        }

        $("#total_discount_percentage").on("input", function() {
            var discountPercentage = parseFloat($('#total_discount_percentage').val());

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
            updateFinalAmount();
        });

        $("#total_discount_amount").on("input", function() {
            var discountAmount = parseFloat($(this).val());

            if (!isNaN(discountAmount)) {
                // Percentage formula = (Value/Total value) × 100
                var discountPercentage = (discountAmount / parseInt($('#sub_total').val())) * 100;
                $("#total_discount_percentage").val(discountPercentage.toFixed(0));
            } else {
                $("#total_discount_percentage").val("");
            }
        });

        function calculateServiceCharges() {
            var taxPercentage = parseFloat($('#total_service_charge').val());

            if (!isNaN(taxPercentage)) {
                var taxAmount = (taxPercentage / 100) * parseInt($('#sub_total').val());
                $("#total_service_charge_amount").val(taxAmount.toFixed(2));
            } else {
                $("#total_service_charge_amount").val("");
            }
            updateFinalAmount();
        }

        $(document).ready(function() {
            $("#total_service_charge").on("change", calculateServiceCharges);
        });
        $(document).ready(function() {
            $("#total_service_charge").on("input", calculateServiceCharges);
        });


        $("#total_service_charge_amount").on("input", function() {
            var taxAmount = parseFloat($(this).val());

            if (!isNaN(taxAmount)) {
                // Percentage formula = (Value/Total value) × 100
                var taxPercentage = (taxAmount / parseInt($('#sub_total').val())) * 100;
                $("#total_service_charge").val(taxPercentage.toFixed(0));
            } else {
                $("#total_service_charge").val("");
            }
            updateFinalAmount();
        });

        function calculateTax() {
            var taxPercentage = parseFloat($('#total_tax_percentage').val());

            if (!isNaN(taxPercentage)) {
                var taxAmount = (taxPercentage / 100) * parseInt($('#sub_total').val());
                $("#total_tax_amount").val(taxAmount.toFixed(2));
            } else {
                $("#total_tax_amount").val("");
            }
            updateFinalAmount();
        }

        $(document).ready(function() {
            $("#total_tax_percentage").on("change", calculateTax);
        });

        $(document).ready(function() {
            $("#total_tax_percentage").on("input", calculateTax);
        });


        $("#total_tax_amount").on("input", function() {
            var taxAmount = parseFloat($(this).val());

            if (!isNaN(taxAmount)) {
                // Percentage formula = (Value/Total value) × 100
                var taxPercentage = (taxAmount / parseInt($('#sub_total').val())) * 100;
                $("#total_tax_percentage").val(taxPercentage.toFixed(0));
            } else {
                $("#total_tax_percentage").val("");
            }
            updateFinalAmount();
        });

        function calculateGreenTax() {
            var taxPercentage = parseFloat($('#total_green_tax_percentage').val());

            if (!isNaN(taxPercentage)) {
                var taxAmount = (taxPercentage / 100) * parseInt($('#sub_total').val());
                $("#total_green_tax_amount").val(taxAmount.toFixed(2));
            } else {
                $("#total_green_tax_amount").val("");
            }
            updateFinalAmount();
        }

        $(document).ready(function() {
            $("#total_green_tax_percentage").on("change", calculateGreenTax);
        });
        $(document).ready(function() {
            $("#total_green_tax_percentage").on("input", calculateGreenTax);
        });


        $("#total_green_tax_amount").on("input", function() {
            var taxAmount = parseFloat($(this).val());

            if (!isNaN(taxAmount)) {
                // Percentage formula = (Value/Total value) × 100
                var taxPercentage = (taxAmount / parseInt($('#sub_total').val())) * 100;
                $("#total_green_tax_percentage").val(taxPercentage.toFixed(0));
            } else {
                $("#total_green_tax_percentage").val("");
            }
            updateFinalAmount();
        });

        function updateFinalAmount() {
            var shareAmount = parseFloat($("#sub_total").val());
            var discountAmount = parseFloat($("#total_discount_amount").val());
            var discountPercentage = parseFloat($("#total_discount_percentage").val());
            var serviceChargesAmount = parseFloat($("#total_service_charge_amount").val());
            var serviceChargesPercentage = parseFloat($("#total_service_charge_percentage").val());
            var taxAmount = parseFloat($("#total_tax_amount").val());
            var taxPercentage = parseFloat($("#total_tax_percentage").val());
            var greenTaxAmount = parseFloat($("#total_green_tax_amount").val());
            var greenTaxPercentage = parseFloat($("#total_green_tax_percentage").val());
            var ConversionRate = parseFloat($('#conversion_rate').val()) || 1;
            var currency = $('#currency_id option:selected').text() || '$';

            if (!isNaN(shareAmount)) {
                var totalAmount = shareAmount;

                if (!isNaN(discountAmount)) {
                    totalAmount -= discountAmount;
                } else if (!isNaN(discountPercentage)) {
                    totalAmount -= (discountPercentage / 100) * shareAmount;
                }

                if (!isNaN(taxAmount)) {
                    totalAmount += taxAmount;
                } else if (!isNaN(taxPercentage)) {
                    totalAmount += (taxPercentage / 100) * shareAmount;
                }
                if (!isNaN(serviceChargesAmount)) {
                    totalAmount += serviceChargesAmount;
                } else if (!isNaN(serviceChargesPercentage)) {
                    totalAmount += (serviceChargesPercentage / 100) * shareAmount;
                }
                if (!isNaN(greenTaxAmount)) {
                    totalAmount += greenTaxAmount;
                } else if (!isNaN(greenTaxPercentage)) {
                    totalAmount += (greenTaxPercentage / 100) * shareAmount;
                }

                var totalConvertedAmount = totalAmount / ConversionRate;

                $(".total_amount").val(totalConvertedAmount.toFixed(2));
                $("#total_amount").text("$ " + totalConvertedAmount.toFixed(2));
                $(".total_amount_converted").val(totalAmount.toFixed(2));
                $("#total_amount_converted").text(currency + totalAmount.toFixed(2));
            }
        }

        // Trigger the update on input change for discount and tax inputs
        $("#total_discount_amount, #total_discount_percentage, #total_tax_amount, #total_tax_percentage").on(
            "input",
            function() {
                updateFinalAmount();
            });

        $("#payment").on("input", function() {
            // Get the total amount
            var totalAmount = parseFloat($(".total_amount_converted").val()) || 0;
            var currency = $('#currency_id option:selected').text() || '$';

            // Get the entered payment amount
            var paymentAmount = parseFloat($(this).val()) || 0;

            // Calculate due and advance amounts
            var dueAmount = Math.max(totalAmount - paymentAmount, 0);
            var advanceAmount = Math.max(paymentAmount - totalAmount, 0);

            // Update the UI with the calculated values
            $(".due_amount").val(dueAmount.toFixed(2));
            $("#due_amount").text(currency + dueAmount.toFixed(2));

            $(".advance_amount").val(advanceAmount.toFixed(2));
            $("#advance_amount").text("$ " + advanceAmount.toFixed(2));
            updatePayment();
        });

        function getProductId(select) {
            var selectedProcedure = select.options[select.selectedIndex].value;
            var repeaterWrapper = $(select).closest('.repeater-wrapper');

            $.ajax({
                type: "POST",
                data: {
                    "product_id": selectedProcedure,
                },
                url: "{{ url('api/product/getById') }}",
                dataType: 'json',
                success: function(result) {
                    var data = result.data;
                    var totalAmount = data.price;
                    repeaterWrapper.find(".charges").val(data.price ?? null);
                    repeaterWrapper.find(".amount").val(data.price ?? null);
                    repeaterWrapper.find(".personsrooms").val(1 ?? null);
                    repeaterWrapper.find(".quantity").val(1 ?? null);
                    $(".sub_total").val(parseFloat(totalAmount ?? 00).toFixed(2));
                    $("#sub_total").text("$ " + parseFloat(totalAmount ?? 00).toFixed(2));
                    $(".total_amount").val(parseFloat(totalAmount ?? 00).toFixed(2));
                    $("#total_amount").text("$ " + parseFloat(totalAmount ?? 00).toFixed(2));
                    calculateTotalAmount();
                    updateFinalAmount();
                    calculateTax();
                    calculateServiceCharges();
                }
            });
        }

        function getByCurrencyId(select) {
            var selectedCurrency = select.options[select.selectedIndex].value;

            $.ajax({
                type: "POST",
                data: {
                    "currency_id": selectedCurrency,
                },
                url: "{{ url('api/currency/getById') }}",
                dataType: 'json',
                success: function(result) {
                    var data = result.data;
                    $('#conversion_rate').val(data.conversion_rate);
                    calculateTotalAmount();
                }
            });
        }

        function getProductsByCategoryId(select) {
            var selectedProductCategory = select.value; // Use select.value directly

            // Find the closest repeater wrapper
            var repeaterWrapper = $(select).closest('.repeater-wrapper');

            // Find the product dropdown within the repeater wrapper
            var productDropdown = repeaterWrapper.find('.product-dropdown');

            // Make an AJAX request
            $.ajax({
                type: "POST",
                data: {
                    "product_category_id": selectedProductCategory,
                },
                url: "{{ url('api/product/getByCategoryId') }}",
                dataType: 'json',
                success: function(result) {
                    var data = result.data;

                    // Clear existing options in the product dropdown
                    productDropdown.empty();

                    // Add the initial "Please select" option
                    productDropdown.append('<option value="">Please select</option>');

                    // Add new options based on the result
                    $.each(data, function(index, product) {
                        productDropdown.append('<option value="' + product.id + '">' +
                            product.name + '</option>');
                    });
                }
            });
        }

        $(document).on('click', '[data-repeater-delete]', function() {
            // Get the deleted row
            var deletedRow = $(this).closest('[data-repeater-item]');

            // Get the charges of the deleted row
            var deletedCharges = parseFloat(deletedRow.find(".charges").val()) || 0;

            // Subtract the charges of the deleted row from the total amount
            var currentTotalAmount = parseFloat($("#amount").val()) || 0;
            var newTotalAmount = Math.max(currentTotalAmount - deletedCharges, 0);

            // Update the total amount
            $("#amount").val(newTotalAmount.toFixed(2));

            // Remove the procedure from the group
            deletedRow.find(".procedure-dropdown").val("");

            // Remove the entire repeater item
            deletedRow.remove();

            // Recalculate the total amount
            calculateTotalAmount();
        });

        // Attach the change event to the product category dropdown
        // $('.product-category-dropdown').on('change', function() {
        //     getProductsByCategoryId(this);
        // });
        $(document).on('change', '.product-category-dropdown', function() {
            getProductsByCategoryId(this);
        });

        // Attach event handler to all procedure dropdowns
        $(document).on('change', '.product-dropdown', function() {
            getProductId(this);
        });

        $(document).on('change', '#currency_id', function() {
            getByCurrencyId(this);
        });
    });

    function updatePayment() {
        var currency = $('#currency_id option:selected').text() || '$';
        var selectedValue = $("#payment_mode").val();
        var totalAmount = parseFloat($("#payment").val()) || 0;
        var cardCharges = 0.035 * totalAmount;

        if (selectedValue == 'Card') {
            $('#card_charges').show();
            $("#credit_card_input").val(cardCharges.toFixed(2));
            $("#total_amount_paid").val((cardCharges + totalAmount).toFixed(2));
        } else {
            $('#card_charges').hide();
            $("#credit_card_input").val('');
            $("#total_amount_paid").val((totalAmount - cardCharges).toFixed(2));
        }
    }

    $(document).ready(function() {
        $("#payment_mode").on("change", function() {
            updatePayment();
        });
        $('#card_charges').hide();
    });

    $(document).ready(function() {
        $('.save-invoice').click(function(e) {
            // Prevent the button from triggering its default action (e.g., submitting a form)
            e.preventDefault();

            // Get the value of the dure_amount input
            var payment = $('#payment').val();
            var total_amount = $('.total_amount_converted').val();
            var due_amount = $('.due_amount').val();
            // Check if dure_amount is 0
            if (parseFloat(payment) > parseFloat(total_amount)) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Payment amount cannot exceed total amount',
                    showConfirmButton: false,
                    timer: 2500
                });
            } else {
                $('#invoiceStatus').val($(this).val());
                $('#invoiceForm').submit();
            }
        });
        $('.close-invoice').click(function(e) {
            // Prevent the button from triggering its default action (e.g., submitting a form)
            e.preventDefault();

            // Get the value of the dure_amount input
            var payment = $('#payment').val();
            var total_amount = $('.total_amount_converted').val();
            // Check if dure_amount is 0
            if (parseFloat(payment) == parseFloat(total_amount)) {
                // Submit the form if dure_amount is 0
                $('#invoiceStatus').val($(this).val());
                $('#invoiceForm').submit();
            } else if (parseFloat(payment) > parseFloat(total_amount)) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Payment amount cannot exceed total amount',
                    showConfirmButton: false,
                    timer: 2500
                });
            } else {
                // Show an alert if dure_amount is not 0
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Amount Should be Paid Fully! ',
                    showConfirmButton: false,
                    timer: 2500
                })
            }
        });
    });
</script>
