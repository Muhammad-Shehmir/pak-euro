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


        <title>BW - Quote - PDF</title>

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

            .border {
                border: 1px solid #dee2e6;
            }

            .border-bottom {
                border-bottom: 1px solid #dee2e6;
            }

            .p-2 {
                padding-right: 0.5rem;
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
                padding-right: 0.75rem;
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

            .footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                text-align: center;
            }

            .footer-table {
                margin: 0 auto;
                font-size: 10px !important;
            }

            .footer-table th,
            .footer-table td {
                padding-right: 15px !important;
            }

            .footer-info {
                font-weight: bold;
                text-align: center;
                font-size: 12px !important;
                margin-bottom: 0;
            }
        </style>
    </head>

<body style="border: none !important;  font-family: Arial, Helvetica, sans-serif !important;">
    <!-- Content -->
    <div class="row invoice-preview" style="margin-right: 0px !important">
        <!-- Invoice -->
        <div class="col-xl-12 col-md-12 mb-md-0 mb-4">
            <div class="card invoice-preview-card" style="border: none !important">
                <div class="col-md-6">
                    <div style="display: inline-block !important; vertical-align: top !important; margin-right: 370px;">
                        <img src="./blue-logo.png" width="150px" height="40px" class="mb-2 app-brand-text fw-bold">
                    </div>
                    <div style="display: inline-block !important; vertical-align: top !important;">
                        <h5 class="mb-1">Quotation # {{ $quote->id }}</h5>
                        <div class="mb-4">
                            <span class="fw-medium">Date :</span>
                            {{-- <span>{{ \Carbon\Carbon::parse($quote->date)->format('d M Y') }}</span> --}}
                            <span>{{ $quote->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6" style="margin-top: 5%">
                    <div style="display: inline-block !important; vertical-align: top !important;">
                        <h3 style="font-size: 12px !important; font-weight: bold !important;">Blueworld</h3>
                        <p style="font-size: 10px !important; margin-top: 0 !important;">Sosun Magu, Dharavandhoo,<br>Baa Atoll, Maldives <br>Reg. No: SP-2917/2015 <br>Tin No: 1067325GST501 <br>Mob. No: +960 760 6409, +960 975 4444 <br>E Mail: info@blueworlddharavandhoo.com <br>Website: blueworlddharavandhoo.com</p>
                    </div>
                </div> --}}
                <div class="card-body">
                    <div>
                        <div class="mb-xl-0 pb-3" style="float: left !important;">
                            <h6 style="font-size: 14px !important;" class="fw-bold mb-1">Quote To:</h6>
                            <table style="">
                                <tbody>
                                    <tr>
                                        <td style="font-size: 12px !important;" class="pe-3 fw-bold">Name:</td>
                                        <td style="font-size: 12px !important;">{{ optional($quote->customer)->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 12px !important;" class="pe-3 fw-bold">Phone#:</td>
                                        <td style="font-size: 12px !important;">
                                            {{ optional($quote->customer)->phone_no }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 12px !important;" class="pe-3 fw-bold">Origin:</td>
                                        <td style="font-size: 12px !important; text-transform: capitalize !important;">
                                            {{ $quote->origin }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 12px !important;" class="pe-3 fw-bold">Pax:</td>
                                        <td style="font-size: 12px !important;">{{ $quote->pax }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 12px !important;" class="pe-3 fw-bold">Meal Plan:</td>
                                        <td style="font-size: 12px !important;">{{ $quote->meal_plan }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-0"
                            style="text-align: right !important; margin-left:76% !important; margin-bottom: 18%">
                            <table style="text-align: right !important">
                                <tbody>
                                    <tr>
                                        <td style="font-size: 12px !important;" class="pe-3 fw-bold">Date From:</td>
                                        <td style="font-size: 12px !important;">
                                            {{ Carbon\Carbon::parse($quote->date)->format('d/M/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 12px !important;" class="pe-3 fw-bold">Date To:</td>
                                        <td style="font-size: 12px !important;">
                                            {{ Carbon\Carbon::parse($quote->valid_till)->format('d/M/Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table m-0 table-bordered">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px !important; padding-right: 8px !important;">S.No</th>
                                    <th style="font-size: 12px !important; padding-right: 8px !important;">Product</th>
                                    <th style="font-size: 12px !important; padding-right: 8px !important;">Rate</th>
                                    <th style="font-size: 12px !important; padding-right: 8px !important;">Persons /
                                        Rooms</th>
                                    <th style="font-size: 12px !important; padding-right: 8px !important;">Days / Dives
                                    </th>
                                    {{-- <th style="font-size: 12px !important; padding-right: 8px !important;">Discount</th>
                                <th style="font-size: 12px !important; padding-right: 8px !important;">Tax</th> --}}
                                    <th style="font-size: 12px !important; padding-right: 8px !important;">Amount</th>
                                    <th style="font-size: 12px !important; padding-right: 8px !important;">Converted
                                        Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quote->quote_detail as $index => $item)
                                    <tr>
                                        <td style="font-size: 10px !important; padding-right:10px !important;">
                                            {{ $index + 1 }}</td>
                                        <td style="font-size: 10px !important; padding-right:10px !important;">
                                            {{ $item->product->name }}</td>
                                        <td style="font-size: 10px !important; padding-right:10px !important;">
                                            {{ '$ ' . number_format($item->charges, 2, '.', '') }}</td>
                                        <td style="font-size: 10px !important; padding-right:10px !important;">
                                            {{ $item->persons_rooms }}</td>
                                        <td style="font-size: 10px !important; padding-right:10px !important;">
                                            {{ $item->days_dives }}</td>
                                        {{-- <td style="font-size: 10px !important; padding-right:10px !important;">{{ $item->discount ?? 0 }}%</td>
                                    <td style="font-size: 10px !important; padding-right:10px !important;">{{ $item->tax ?? 0 }}%</td> --}}
                                        <td style="font-size: 10px !important; padding-right:10px !important;">
                                            {{ '$ ' . $item->amount }}</td>
                                        <td style="font-size: 10px !important; padding-right:10px !important;">
                                            {{ $quote->currency->name . ' ' . $item->converted_amount }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td style="font-size: 10px !important; padding-right:10px !important;"
                                        colspan="6" class="text-end fw-bold">Sub
                                        Total:</td>
                                    <td style="font-size: 10px !important; padding-right:10px !important;"
                                        class="fw-bold">
                                        {{ $quote->currency->name . ' ' . $quote->sub_total }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px !important; padding-right:10px !important;"
                                        colspan="6" class="text-end fw-bold">
                                        Discount:</td>
                                    <td style="font-size: 10px !important; padding-right:10px !important;">
                                        {{ $quote->currency->name . ' ' . $quote->total_discount_amount ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px !important; padding-right:10px !important;"
                                        colspan="6" class="text-end fw-bold">Tax:
                                    </td>
                                    <td style="font-size: 10px !important; padding-right:10px !important;">
                                        {{ $quote->currency->name . ' ' . $quote->total_tax_amount ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px !important; padding-right:10px !important;"
                                        colspan="6" class="text-end fw-bold">
                                        Service Charge:</td>
                                    <td style="font-size: 10px !important; padding-right:10px !important;">
                                        {{ $quote->currency->name . ' ' . $quote->total_service_charge_amount }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px !important; padding-right:10px !important;"
                                        colspan="6" class="text-end fw-bold">
                                        Green Tax:</td>
                                    <td style="font-size: 10px !important; padding-right:10px !important;">
                                        {{ $quote->currency->name . ' ' . $quote->total_green_tax_amount }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px !important; padding-right:10px !important;"
                                        colspan="6" class="text-end fw-bold">
                                        Total Amount:</td>
                                    <td style="font-size: 10px !important; padding-right:10px !important;"
                                        class="fw-bold">
                                        {{ $quote->currency->name . ' ' . $quote->total_converted_amount }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            {{-- <div style="position: absolute; bottom: 20%; margin-bottom: 7%; width: 100%; text-align: center;">
                <table style="margin: 0 auto;">
                    <thead>
                        <tr>
                            <th style="font-size: 12px !important; padding-right: 8px !important;">Notes</th>
                            <th style="font-size: 12px !important; padding-right: 8px !important;">For Bank Transfers
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size: 10px !important; padding-right: 15px !important;">Rates are quoted
                                for a Double room on a bed & breakfast basis.</td>
                            <td style="font-size: 10px !important; padding-right: 15px !important;">Bank Name : Bank Of
                                Maldives</td>
                        </tr>
                        <tr>
                            <td style="font-size: 10px !important; padding-right: 15px !important;">All Tariffs & Fares
                                would be calculated at 50% for</td>
                            <td style="font-size: 10px !important; padding-right: 15px !important;">Bank Account Name:
                                Mantastic Divers (USD)</td>
                        </tr>
                        <tr>
                            <td style="font-size: 10px !important; padding-right: 15px !important;">children below 12
                                years of age</td>
                            <td style="font-size: 10px !important; padding-right: 15px !important;">Bank Account Number
                                : 7730000399215</td>
                        </tr>
                        <tr>
                            <td style="font-size: 10px !important; padding-right: 15px !important;">All Tariffs and
                                Fares are subject to change without prior notice</td>
                            <td style="font-size: 10px !important; padding-right: 15px !important;">Swift Code :
                                MALBMVMV</td>
                        </tr>
                        <tr>
                            <td style="font-size: 10px !important; padding-right: 15px !important;"></td>
                            <td style="font-size: 10px !important; padding-right: 15px !important;">Payment Terms : 25%
                                advance & rest on arrival</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="position: absolute; bottom: 0; margin-left: 25%;">
                <p style="font-weight: bold; text-align:center; font-size:12px !important;" class="mb-1">
                    www.blueworlddharavandhoo.com,
                    info@blueworlddharavandhoo.com </p>
                <p style="font-weight: bold; text-align:center; font-size:12px !important;" class="mb-0">Mob. No:
                    +960 760 6409, +960 975 4444</p>
                <p style="font-weight: bold; text-align:center; font-size:12px !important;" class="mb-0">Tin No:
                    1067325GST501 Reg. No: SP-2917/2015</p>
                <p style="font-weight: bold; text-align:center; font-size:12px !important;" class="mb-0">Sosun Magu,
                    Dharavandhoo, Baa Atoll, Maldives</p>
            </div> --}}
            <div class="footer">
                <table class="footer-table">
                    <thead>
                        <tr>
                            <th style="font-size: 12px !important;">Notes</th>
                            <th style="font-size: 12px !important;">For Bank Transfers</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Rates are quoted for a Double room on a bed & breakfast basis.</td>
                            <td>Bank Name: Bank Of Maldives</td>
                        </tr>
                        <tr>
                            <td>All Tariffs & Fares would be calculated at 50% for</td>
                            <td>Bank Account Name: Mantastic Divers (USD)</td>
                        </tr>
                        <tr>
                            <td>children below 12 years of age</td>
                            <td>Bank Account Number: 7730000399215</td>
                        </tr>
                        <tr>
                            <td>All Tariffs and Fares are subject to change without prior notice</td>
                            <td>Swift Code: MALBMVMV</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Payment Terms: 25% advance & rest on arrival</td>
                        </tr>
                    </tbody>
                </table>
                <p style="margin-top: 5%" class="footer-info">www.blueworlddharavandhoo.com, info@blueworlddharavandhoo.com</p>
                <p class="footer-info">Mob. No: +960 760 6409, +960 975 4444</p>
                <p class="footer-info">Tin No: 1067325GST501 Reg. No: SP-2917/2015</p>
                <p class="footer-info">Sosun Magu, Dharavandhoo, Baa Atoll, Maldives</p>
            </div>
        </div>
    </div>
    <!-- /Invoice -->
    </div>
    {{-- {{ dd($quote) }} --}}

    {{-- {{ dd($quote) }} --}}
    <!-- / Content -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

</body>

</html>
