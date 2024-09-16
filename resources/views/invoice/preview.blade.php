@extends('layout.master')

<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .invoice-actions {
            display: none;
        }

        .invoice-preview,
        .invoice-preview * {
            visibility: visible;
        }

        .card {
            box-shadow: none !important;
            background-color: transparent !important;
            position: relative;
            min-height: 95vh;
            /* Change height to min-height */
            display: flex;
            flex-direction: column;
            /* Make it a flex container with column layout */
        }

        .card-body {
            /* Assuming card content is within a .card-content element */
            flex-grow: 1;
            /* Allow content to expand and fill available space */
        }

        .invoice-preview {
            width: 100%;
            min-height: 95vh;
            /* Change height to min-height */
            position: absolute;
            left: 1%;
            top: 1%;
            bottom: 0;
        }

        .card-footer {
            width: 100%;
            position: relative;
            margin-top: auto;
            /* Push the footer to the bottom */
        }

        .table-responsive {
            padding: 0;
        }
    }
</style>
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center p-3 py-0">
            <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a
                    href="{{ url('/client-profile/' . $transaction->client_id) }}" class="text-muted fw-light">/
                    Invoice</a><span class="color"> /</span><span class="text-heading fw-bold text-color"> Preview</span>
            </h4>
        </div>

        <div class="row invoice-preview">
            <!-- Invoice Actions -->
            <div class="col-xl-12 col-md-4 mb-3 invoice-actions">
                <div class="card">
                    <div class="card-body d-flex justify-content-evenly">
                        <a href="https://api.whatsapp.com/send?phone=+92 {{ optional($transaction->patient)->whatsapp_no ?: optional($transaction->patient)->phone_no }}&text=Hello%21%20{{ optional($transaction->patient)->name }}."
                            target="_blank" class="btn btn-primary d-grid w-100 mx-3">
                            <span class="d-flex align-items-center text-white justify-content-center text-nowrap">
                                <i class="mdi mdi-send-outline scaleX-n1-rtl me-1"></i>Send Invoice
                            </span>
                        </a>

                        <a class="btn btn-outline-secondary d-grid w-100 mx-3"
                            href="{{ url('/invoice/pdf/' . $transaction->id) }}">Download</a>
                        <button id="printButton" class="btn btn-outline-secondary d-grid w-100 mx-3">
                            Print
                        </button>

                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
            <!-- Invoice -->
            <div class="col-xl-12 col-md-12 mb-md-0 mb-4">
                <div class="card invoice-preview-card">
                    <div class="card-body ">
                        <div style="display: flex; justify-content:space-between;" class="p-2">
                            <div class="mb-xl-0 pb-3">
                                <img src="{{ url('/logo2.png') }}" width="150px" class=" mb-4  app-brand-text fw-bold">
                                <h6 class="mb-1">Bill To:</h6>
                                <table>

                                    <tbody>
                                        <tr>
                                            <td class="pe-3 fw-medium">Name:</td>
                                            <td>{{ optional($transaction->clients)->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3 fw-medium">Phone#:</td>
                                            <td>{{ optional($transaction->clients)->phone_no }}</td>
                                        </tr>
                                        {{-- <tr>
                                            <td class="pe-3 fw-medium">Gender:</td>
                                            <td>{{ optional($transaction->customer)->gender }}</td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                                {{-- <h4>PATEL DENTAL CLINIC</h4>
                                <p class="mb-1"><i class="mdi mdi-map-marker me-2"></i>Suite#7, 128-U Mono tower, Allama
                                </p>

                                <p class="mb-1"><i class="me-4" style="padding-left: 3px"></i>Iqbal off Tariq Road,
                                    PECHS Block
                                    2</p>
                                <p class="mb-0"><i class="mdi mdi-phone me-2"></i>02134555141, 03219257079</p> --}}
                            </div>
                            <div class="mt-3">
                                <h5 class="mb-1">INVOICE # {{ $transaction->tran_no }}</h5>
                                <div class="mb-4">
                                    <span class="fw-medium">Date :</span>
                                    {{-- <span>{{ \Carbon\Carbon::createFromFormat('d/M/Y', $date)->format('d M Y'); }}</span> --}}
                                    <span>{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</span>
                                </div>

                            </div>
                        </div>
                        <div class="table-responsive p-2">
                            <table class="table m-0 table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">S.No</th>
                                        <th style="width: 30px;">Charges</th>
                                        <th style="text-align: center">Description</th>
                                        <th>Rate</th>
                                        <th style="width: 30px;">Quantity</th>
                                        {{-- <th>Discount</th>
                                        <th>Tax</th> --}}
                                        <th style="text-align: center">Amount</th>
                                        <th>Converted Amount {{ @$transaction->currency->name }} </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction->transaction_detail as $index => $item)
                                        <tr>
                                            <td style="width: 30px;">{{ $index + 1 }}</td>
                                            <td style="width: 30px; text-align: center">{{ @$item->charge->name }}</td>
                                            <td class="">{{ $item->description ?? '--' }}</td>
                                            <td class="">{{ (int) $item->rate ?? 0 }}</td>
                                            {{-- <td class="">{{ number_format($item->charges, 2, '.', '') }}</td> --}}
                                            <td style="width: 30px; text-align: center">{{ $item->quantity ?? 1 }}</td>
                                            <td style="text-align: right">{{ 'PKR ' . $item->amount ?? 0 }}</td>
                                            <td style="text-align: right">{{ $item->converted_amount ?? 0 }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between flex-column mt-5">
                                <table class="me-2">
                                    <tbody class="d-flex justify-content-between">
                                        {{-- <tr>
                                            <td class="pe-3 fw-medium">Payment:</td>
                                            <td>{{ $transaction->currency->name }}
                                                {{ number_format($totalAmountPaid, 2, '.', '') }}</td>
                                        </tr> --}}
                                        {{-- <tr>
                                            <td class="pe-3 fw-medium">Due:</td>
                                            <td>{{ $transaction->currency->name }} {{ $totalAmountRemaining ?? 0 }}</td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                                <div class="">
                                    @if ($transaction->total_discount_amount != 0 || $transaction->total_tax_amount != 0)
                                        <table class="me-2 mt-4 w-100">
                                            <tbody class="d-flex justify-content-between">
                                                <tr>
                                                    <td class="pe-3 fw-medium">Sub Total:</td>
                                                    <td> {{ 'PKR ' . $transaction->amount }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-3 pe-3 fw-medium">Discount:</td>
                                                    <td>
                                                        {{ 'PKR ' . @$transaction->total_discount_amount ?? 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-3 pe-3 fw-medium">Tax:</td>
                                                    <td>
                                                        {{ 'PKR ' . @$transaction->total_tax_amount ?? 0 }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="me-2 mt-4 w-100">
                                            <tbody class="d-flex justify-content-between">
                                                {{-- <tr>
                                                    <td class="fw-medium">Service Charges :</td>
                                                    <td>{{ $transaction->currency->name }}
                                                        {{ $transaction->total_service_charge_amount ?? 0 }}</td>
                                                </tr> --}}

                                            </tbody>
                                        </table>
                                    @endif
                                    <table class="my-3 text-end table table-bordered">
                                        <thead>
                                            <tr>
                                                <td class="p-2  text-end" colspan="5">Total Amount:</td>
                                                <td class="p-2">
                                                    {{-- {{ $transaction->total_converted_amount }} --}}
                                                    {{ 'PKR ' . $transaction->total_amount }}
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- <tr>
                                                <td class="text-center" colspan="6">
                                                    Payment History
                                                </td>
                                            </tr>
                                            @php
                                                $totalPaid = 0;
                                            @endphp
                                            @foreach (@$transaction->payments as $payment)
                                                @php
                                                    $totalPaid += $payment->amount_paid;
                                                @endphp
                                                <tr>
                                                    <td class="p-2 fw-medium">Date:</td>
                                                    <td class="p-2">
                                                        {{ \Carbon\Carbon::parse($payment->created_at)->format('d/m/Y') }}
                                                    </td>

                                                    <td class="p-2 fw-medium">Remaining
                                                        Amount:
                                                    </td>
                                                    <td class="p-2">
                                                        {{ $transaction->currency->name }}
                                                        {{ number_format((int) $transaction->total_converted_amount - (int) $totalPaid, 2, '.', '') }}
                                                    </td>

                                                    <td class="p-2 fw-medium">Amount Paid:
                                                    </td>
                                                    <td class="p-2">
                                                        {{ $transaction->currency->name }}
                                                        {{ number_format($payment->amount_paid, 2, '.', '') }}</td>
                                                </tr>
                                            @endforeach --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12 flex-column justify-content-center align-items-center">
                                {{-- <p class="mb-0">www.blueworldmaldives.com,
                                    info@blueworldmaldives.com </p>
                                <p> +960 7-606409, +960 795-4444</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Invoice -->
        </div>

    </div>
    <!--/ Content -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var printButton = document.getElementById("printButton");

            if (printButton) {
                printButton.addEventListener("click", function() {
                    window.print();
                });
            }
        });
    </script>
@endsection
