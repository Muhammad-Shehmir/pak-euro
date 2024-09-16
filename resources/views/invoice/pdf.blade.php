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


        <title>FC - Invoice - PDF</title>

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
                padding: 0.5rem;
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

            .ms-2 {
                margin-left: 0.5rem;
            }

            .small {
                font-size: 75%;
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
                    <div style="display: inline-block !important; vertical-align: top !important; margin-right: 300px;">
                        <img src="./logo2.png" width="150px" class="mb-2 app-brand-text fw-bold">
                    </div>
                    {{-- <div
                        style="display: inline-block !important; vertical-align: top !important; font-size: 14px !important">
                        <h5 class="mb-1">FrieghtCare</h5>
                        <div class="mb-4" style="font-size: 12px !important;">
                            <span>Sosun Magu, Dharavandhoo,<br> Baa Atoll, Maldives <br> Reg. No: SP-2917/2015 <br> Tin
                                No: 1067325GST501 <br> Mob. No: +960 760 6409, +960 975 4444 <br> E Mail:
                                info@blueworlddharavandhoo.com <br> Website: blueworlddharavandhoo.com</span>
                        </div>
                    </div> --}}
                </div>
                {{-- <div class="col-md-6" style="margin-top: 5%">
                        <div style="display: inline-block !important; vertical-align: top !important;">
                            <h3 style="font-size: 12px !important; font-weight: bold !important;">Blueworld</h3>
                            <p style="font-size: 10px !important; margin-top: 0 !important;">Sosun Magu, Dharavandhoo,<br>Baa Atoll, Maldives <br>Reg. No: SP-2917/2015 <br>Tin No: 1067325GST501 <br>Mob. No: +960 760 6409, +960 975 4444 <br>E Mail: info@blueworlddharavandhoo.com <br>Website: blueworlddharavandhoo.com</p>
                        </div>
                    </div> --}}
                <div class="card-body">
                    <div style="margin-bottom: 18% !important;">
                        <h6 style="font-size: 14px !important; text-align:center" class="fw-bold mb-1">Invoice</h6>
                        <div class="mb-xl-0 pb-3" style="float: left !important;">
                            <table style="">
                                <tbody>
                                    <tr>
                                        <td style="font-size: 12px !important; font-weight: bold !important;"
                                            class="pe-3 fw-bold">Client Name:</td>
                                        <td style="font-size: 12px !important;">
                                            {{ optional($transaction->clients)->name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 12px !important; font-weight: bold !important;"
                                            class="pe-3 fw-bold">Address:</td>
                                        <td style="font-size: 12px !important; text-transform: capitalize !important;">
                                            {{ optional($transaction->clients)->address }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 12px !important; font-weight: bold !important;"
                                            class="pe-3 fw-bold"> Mobile Number:
                                        </td>
                                        <td style="font-size: 12px !important;">
                                            {{ optional($transaction->clients)->phone_no }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td style="font-size: 12px !important; font-weight: bold !important;"
                                            class="pe-3 fw-bold">Source:</td>
                                        <td style="font-size: 12px !important;">
                                            {{ optional($transaction->clients)->customer_source }}</td>
                                    </tr> --}}
                                    <tr>
                                        <td style="font-size: 12px !important; font-weight: bold !important;"
                                            class="pe-3 fw-bold"> Invoice Number:
                                        </td>
                                        <td style="font-size: 12px !important;">{{ $transaction->tran_no }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 12px !important; font-weight: bold !important;"
                                            class="pe-3 fw-bold"> Date:</td>
                                        <td style="font-size: 12px !important;">
                                            {{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="mt-0"
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

                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table m-0 table-bordered">
                            <thead>
                                <tr>
                                    <th
                                        style="font-size: 12px !important; padding-right: 8px !important; background-color: dodgerblue;">
                                        S.No</th>
                                    <th
                                        style="font-size: 12px !important; padding-right: 8px !important; background-color: dodgerblue;">
                                        Charges</th>
                                    <th
                                        style="font-size: 12px !important; padding-right: 8px !important; background-color: dodgerblue;">
                                        Description</th>
                                    <th
                                        style="font-size: 12px !important; padding-right: 8px !important; background-color: dodgerblue;">
                                        Rate</th>
                                    </th>
                                    <th
                                        style="font-size: 12px !important; padding-right: 8px !important; background-color: dodgerblue;">
                                        Quantity</th>
                                    </th>
                                    <th
                                        style="font-size: 12px !important; padding-right: 8px !important; background-color: dodgerblue;">
                                        Amount</th>
                                    <th
                                        style="font-size: 12px !important; padding-right: 8px !important; background-color: dodgerblue;">
                                        Converted Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction->transaction_detail as $index => $item)
                                    <tr>
                                        <td style="font-size: 10px !important; padding-right:10px !important;">
                                            {{ $index + 1 }}</td>
                                        <td style="font-size: 10px !important; padding-right:10px !important;">
                                            {{ $item->charge->name ?? '--' }}</td>
                                        <td style="font-size: 10px !important; padding-right:10px !important;">
                                            {{ $item->description ?? '--' }}</td>
                                        <td style="font-size: 10px !important; padding-right:10px !important;">
                                            {{ number_format($item->rate, 2, '.', '') }}</td>
                                        <td style="font-size: 10px !important; padding-right:10px !important;">
                                            {{ $item->quantity ?? 1 }}</td>
                                        <td style="font-size: 10px !important; padding-right:10px !important;">
                                            {{ 'PKR ' . number_format($item->amount, 2, '.', '') }}</td>
                                        <td style="font-size: 10px !important; padding-right:10px !important;">
                                            {{ @$transaction->currency->name }} {{  number_format($item->converted_amount, 2, '.', '') }}</td>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td style="font-size: 10px !important; padding-right:10px !important;"
                                        colspan="6" class="text-end fw-bold">Sub
                                        Total:</td>
                                    <td style="font-size: 10px !important; padding-right:10px !important;"
                                        class="fw-bold">
                                        {{ 'PKR ' . @$transaction->amount }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px !important; padding-right:10px !important;"
                                        colspan="6" class="text-end fw-bold">
                                        Tax:</td>
                                    <td style="font-size: 10px !important; padding-right:10px !important;">
                                        {{ 'PKR ' . $transaction->total_tax_amount ?? 0 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px !important; padding-right:10px !important;"
                                        colspan="6" class="text-end fw-bold">Discount:
                                    </td>
                                    <td style="font-size: 10px !important; padding-right:10px !important;">
                                        {{ 'PKR ' . $transaction->total_discount_amount ?? 0 }}
                                    </td>
                                </tr>
                               {{--  <tr>
                                    <td style="font-size: 10px !important; padding-right:10px !important;"
                                        colspan="5" class="text-end fw-bold">
                                        Card Payment Charges:</td>
                                    <td style="font-size: 10px !important; padding-right:10px !important;">
                                        {{ $transaction->currency->name . ' ' . $transaction->card_charges_converted_amount }}
                                    </td>
                                </tr> --}}
                                {{-- <tr>
                                    <td style="font-size: 10px !important; padding-right:10px !important;"
                                        colspan="5" class="text-end fw-bold">
                                        Green Tax:</td>
                                    <td style="font-size: 10px !important; padding-right:10px !important;">
                                        {{ $transaction->currency->name . ' ' . $transaction->total_green_tax_amount }}
                                    </td>
                                </tr> --}}
                                <tr>
                                    <td style="font-size: 10px !important; padding-right:10px !important;"
                                        colspan="6" class="text-end fw-bold">
                                        Grand Total:</td>
                                    <td style="font-size: 10px !important; padding-right:10px !important;"
                                        class="fw-bold">
                                        {{ 'PKR ' . $transaction->total_amount }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="footer">
                {{-- <table class="footer-table">
                    <thead>
                        <tr>
                            <th style="font-size: 12px !important;">For Bank Transfers</th>
                            <th style="font-size: 12px !important;">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size: 10px !important;">Bank Name: Bank Of Maldives</td>
                            <td style="font-size: 10px !important;">Cheque Payments : Mantastic Divers</td>
                        </tr>
                        <tr>
                            <td style="font-size: 10px !important;">Account Name: Mantastic Divers (USD)</td>
                            <td style="font-size: 10px !important;">Any dicrepency in the invoice should be reported
                                within 48 hours</td>
                        </tr>
                        <tr>
                            <td style="font-size: 10px !important;">Account Number: 7730000399215</td>
                            <td style="font-size: 10px !important;">Please include invoice Number for Cheque Payments
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 10px !important;">Swift Code: MALBMVMV</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size: 10px !important;">Payment Terms: Immediate</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table> --}}
                <div class="business" style="margin-top: 10%; text-align: center;">
                    {{-- <div class="head">
                        <h2 style="font-size: 20px;">Thanks in Advance for your Business</h2>
                    </div>
                    <div class="head"
                        style="margin: 1.6%; border: 1px solid; background-color: dodgerblue; border: none; color: white; padding-top: 8px;">
                        <h2 style="font-size: 20px;">Best Things
                            Happen at sea!!!</h2>
                    </div> --}}
                </div>
                {{-- <p style="margin-top: 5%" class="footer-info">www.blueworlddharavandhoo.com,
                    info@blueworlddharavandhoo.com</p>
                <p class="footer-info">Mob. No: +960 760 6409, +960 975 4444</p>
                <p class="footer-info">Tin No: 1067325GST501 Reg. No: SP-2917/2015</p>
                <p class="footer-info">Sosun Magu, Dharavandhoo, Baa Atoll, Maldives</p> --}}
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
