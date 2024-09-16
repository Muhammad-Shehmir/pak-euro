<!DOCTYPE html>
<html lang="en" class="light-style" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/"
    data-template="horizontal-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <html lang="en" class="light-style" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/"
        data-template="horizontal-menu-template">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


        <title>PDC - Invoice - PDF</title>

        <meta name="description" content="" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" /> --}}
        <style>
            .container {
                max-width: 900px;
                margin: auto;
            }

            Download Copy code .row {
                display: flex;
                flex-wrap: wrap;
            }

            .col-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .p-2 {
                padding: 0.5rem;
            }

            .mt-3 {
                margin-top: 1rem;
            }

            .text-nowrap {
                white-space: nowrap;
            }

            .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #212529;
            }

            .table-bordered {
                border: 1px solid #dee2e6;
            }

            .table td,
            .table th {
                padding: 0.75rem;
                vertical-align: top;
                border-top: 1px solid #dee2e6;
            }

            .table-bordered th,
            .table-bordered td {
                border: 1px solid #dee2e6;
            }

            .fw-medium {
                font-weight: 500;
            }
        </style>
    </head>

<body>
    <!-- Content -->

    <div class="row invoice-preview" style="border: none">
        <!-- Invoice -->
        <div class="col-xl-12 col-md-12  mb-md-0 mb-4">
            <div class="card invoice-preview-card" style="border: none">
                <div class="card-body" style="border: none">
                    <div>
                        <div class="mb-xl-0 pb-3" style="float: left !important;">
                            <img src="./blue-logo.png" width="150px" height="40px"
                                class="mb-4 app-brand-text fw-bold">

                            {{-- <h4>PATEL DENTAL CLINIC</h4>
                            <p class="mb-1"><i class="mdi mdi-map-marker me-2"></i>Suite#7, 128-U Mono tower, Allama
                            </p>

                            <p class="mb-1"><i class="me-4" style="padding-left: 3px"></i>Iqbal off Tariq Road,
                                PECHS Block
                                2</p>
                            <p class="mb-0"><i class="mdi mdi-phone me-2"></i>02134555141, 03219257079</p> --}}
                        </div>
                        <div class="mt-3" style="text-align: right !important; margin-bottom: 10%">
                            <h5 class="mb-1">INVOICE # {{ $transaction->id }}</h5>
                            <div class="mb-4">
                                <span class="fw-medium">Date :</span>
                                <span>{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</span>
                            </div>
                            <h6 class="mb-1">Bill To:</h6>
                            <table style="margin-left: auto; margin-right: 0; text-align: right;">
                                <tbody>
                                    <tr style="margin-top: 10px">
                                        <td class="pe-3 fw-medium">Name:</td>
                                        <td style="text-align: left; text-transform: capitalize;">
                                            {{ optional($transaction->customer)->name }}</td>
                                    </tr>
                                    <tr style="margin-top: 10px;">
                                        <td class="pe-3 fw-medium">Phone No:</td>
                                        <td style="text-align: left; text-transform: capitalize;">
                                            {{ optional($transaction->customer)->phone_no }}
                                        </td>
                                    </tr>
                                    <tr style="margin-top: 10px;">
                                        <td class="pe-3 fw-medium ">Gender:</td>
                                        <td style="text-align: left; text-transform: capitalize;">
                                            {{ optional($transaction->customer)->gender }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table m-0 table-bordered">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Product</th>
                                {{-- <th>Rate</th> --}}
                                <th>Quantity</th>
                                {{-- <th>Discount</th>
                                <th>Tax</th> --}}
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction->transaction_detail as $index => $item)
                                <tr>
                                    <td class="text-nowrap">{{ $index + 1 }}</td>
                                    <td class="text-nowrap">{{ $item->product->name }}</td>
                                    {{-- <td class="text-nowrap">{{ number_format($item->charges, 2, '.', '') }}</td> --}}
                                    <td class="text-nowrap">{{ $item->quantity }}</td>
                                    {{-- <td class="text-nowrap">{{ $item->discount ?? 0 }}%</td>
                                    <td class="text-nowrap">{{ $item->tax ?? 0 }}%</td> --}}
                                    <td class="text-nowrap">{{ $item->converted_amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between flex-row mt-3">
                        <table style="float: left; margin-left: 20px; margin-top:20px;" class="me-2">
                            <tbody>
                                <tr>
                                    <td class="pe-3 fw-medium">Payment:</td>
                                    <td>Rs. {{ number_format($transaction->payment, 2, '.', '') }}</td>
                                </tr>
                                <tr>
                                    <td class="pe-3 fw-medium">Due:</td>
                                    <td>Rs. {{ $transaction->due_amount ?? 0 }}</td>
                                </tr>
                                {{-- <tr>
                                    <td class="pe-3 fw-medium">Advance:</td>
                                    <td>Rs. {{ $transaction->advance_amount ?? 0 }}</td>
                                </tr> --}}
                            </tbody>
                        </table>
                        <table class="me-2"
                            style="margin-left: auto; margin-right: 20px; text-align: right; margin-top:20px; margin-bottom:20px">

                            <tbody>
                                <tr>
                                    <td class="pe-3 fw-medium">Sub Total:</td>
                                    <td>Rs. {{ $transaction->sub_total }}</td>
                                </tr>
                                <tr>
                                    <td class="pe-3 fw-medium">Discount (%):</td>
                                    <td>{{ $transaction->total_discount_percentage }}%</td>
                                </tr>
                                <tr>
                                    <td class="pe-3 fw-medium">Tax (%):</td>
                                    <td>{{ $transaction->total_tax_percentage }}%</td>
                                </tr>
                                <tr>
                                    <td class="pe-3 fw-medium">Total Amount:</td>
                                    <td>Rs. {{ $transaction->total_converted_amount }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
        <!-- /Invoice -->
    </div>

    <!-- / Content -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

</body>

</html>
