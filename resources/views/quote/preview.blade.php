@extends('layout.master')

<style>
    @media print {
        body * {
            visibility: hidden;
            font-size: 12px !important;
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

        table tr td,
        table tr th {
            font-size: 10px !important;
            padding: 10px !important;
        }

        table.no-padding tr td{
            padding: 3px !important;
        }
    }
</style>
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center p-3 py-0">
            <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a
                    href="{{ url('/quote') }}" class="text-muted fw-light">/ Quote</a><span class="color"> /</span><span
                    class="text-heading fw-bold text-color"> Preview</span>
            </h4>
        </div>

        <div class="row invoice-preview">
            <!-- Invoice Actions -->
            <div class="col-xl-12 col-md-4 mb-3 invoice-actions">
                <div class="card">
                    <div class="card-body d-flex justify-content-evenly">
                        <a href="https://api.whatsapp.com/send?phone= {{ optional($quote->patient)->whatsapp_no ?: optional($quote->patient)->phone_no }}&text=Hello%21%20{{ optional($quote->patient)->name }}."
                            target="_blank" class="btn btn-primary d-grid w-100 mx-3">
                            <span class="d-flex align-items-center text-white justify-content-center text-nowrap">
                                <i class="mdi mdi-send-outline scaleX-n1-rtl me-1"></i>Send Quote
                            </span>
                        </a>

                        <a class="btn btn-outline-secondary d-grid w-100 mx-3"
                            href="{{ url('/quote/pdf/' . $quote->id) }}">Download</a>
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
                        <img src="{{ url('/blue-logo.png') }}" width="150px" height="40px"
                            class=" mb-4  app-brand-text fw-bold">
                        <div style="display: flex; justify-content:space-between;" class="p-2">
                            <div class="mb-xl-0 pb-3">
                                <h6 class="mb-1">Quote To:</h6>
                                <table class="no-padding">

                                    <tbody>
                                        <tr>
                                            <td class="pe-3 fw-medium">Name:</td>
                                            <td>{{ optional($quote->customer)->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3 fw-medium">Phone#:</td>
                                            <td>{{ optional($quote->customer)->phone_no }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3 fw-medium">Origin:</td>
                                            <td class="text-transform: capitalize !important;">{{ $quote->origin }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3 fw-medium">Pax:</td>
                                            <td>{{ $quote->pax }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3 fw-medium">Meal Plan:</td>
                                            <td>{{ $quote->meal_plan }}</td>
                                        </tr>
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
                            <div class="mt-0">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="pe-3 fw-medium">Date From:</td>
                                            <td>{{ Carbon\Carbon::parse($quote->date)->format('d/M/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3 fw-medium">Date To:</td>
                                            <td>{{ Carbon\Carbon::parse($quote->valid_till)->format('d/M/Y') }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="table-responsive p-2">
                            <table class="table m-0 table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Product</th>
                                        <th>Rate</th>
                                        <th>Persons / Rooms</th>
                                        <th>Days / Dives</th>
                                        {{-- <th>Discount</th>
                                        <th>Tax</th> --}}
                                        <th>Amount</th>
                                        <th>Converted Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($quote->quote_detail as $index => $item)
                                        <tr>
                                            <td class="text-nowrap">{{ $index + 1 }}</td>
                                            <td class="text-nowrap">{{ $item->product->name }}</td>
                                            <td class="text-nowrap">{{ '$ ' . number_format($item->charges, 2, '.', '') }}</td>
                                            <td class="text-nowrap">{{ $item->persons_rooms }}</td>
                                            <td class="text-nowrap">{{ $item->days_dives }}</td>
                                            {{-- <td cltext-nowrapass="">{{ $item->discount ?? 0 }}%</td>
                                            <td class="text-nowrap">{{ $item->tax ?? 0 }}%</td> --}}
                                            <td class="text-nowrap">{{ '$ ' . $item->amount }}</td>
                                            <td class="text-nowrap">{{ $quote->currency->name . ' ' . $item->converted_amount }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" class="pe-3 text-end fw-bold">Sub Total:</td>
                                        <td class="fw-bold">{{ $quote->currency->name . ' ' . $quote->sub_total }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="ps-3 text-end pe-3 fw-medium">Discount:</td>
                                        <td>{{ $quote->currency->name . ' ' . $quote->total_discount_amount ?? 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="ps-3 text-end pe-3 fw-medium">Tax:</td>
                                        <td>{{ $quote->currency->name . ' ' . $quote->total_tax_amount ?? 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="p-2 text-end fw-medium">Service Charge:</td>
                                        <td>{{ $quote->currency->name . ' ' . $quote->total_service_charge_amount }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="p-2 text-end fw-medium">Green Tax:</td>
                                        <td>{{ $quote->currency->name . ' ' . $quote->total_green_tax_amount }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="p-2 text-end fw-bold">Total Amount:</td>
                                        <td class="fw-bold">
                                            {{ $quote->currency->name . ' ' . $quote->total_converted_amount }}</td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="d-flex justify-content-between flex-column mt-5">
                                {{-- <table class="me-2">
                                    <tbody class="d-flex justify-content-between">
                                        <tr>
                                            <td class="pe-3 fw-medium">Payment:</td>
                                            <td>{{ number_format($totalAmountPaid, 2, '.', '') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3 fw-medium">Due:</td>
                                            <td>{{ $totalAmountRemaining ?? 0 }}</td>
                                        </tr>
                                    </tbody>
                                </table> --}}
                                {{-- <div class="">
                                    @if ($quote->total_discount_amount != 0 || $quote->total_tax_amount != 0)
                                        <table class="me-2 mt-4 w-100">
                                            <tbody class="d-flex justify-content-between">
                                                <tr>
                                                    <td class="pe-3 fw-medium">Sub Total:</td>
                                                    <td>{{ $quote->currency->name . ' ' . $quote->sub_total }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-3 pe-3 fw-medium">Discount:</td>
                                                    <td>{{ $quote->currency->name . ' ' . $quote->total_discount_amount ?? 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-3 pe-3 fw-medium">Tax:</td>
                                                    <td>{{ $quote->currency->name . ' ' . $quote->total_tax_amount ?? 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-3 pe-3 fw-medium">Service Charge:</td>
                                                    <td>{{ $quote->currency->name . ' ' . $quote->total_service_charge_amount }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-3 pe-3 fw-medium">Green Tax:</td>
                                                    <td>{{ $quote->currency->name . ' ' . $quote->total_converted_amount }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-3 fw-medium">Total Amount:</td>
                                                    <td>{{ $quote->currency->name . ' ' . $quote->total_converted_amount }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endif --}}
                                {{-- <table class="me-2 mt-4 table table-bordered">
                                        <thead>
                                            <tr>
                                                <td class="p-2 fw-medium text-end" colspan="5">Total Amount:</td>
                                                <td class="p-2">{{ $quote->total_converted_amount }}</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center" colspan="6">
                                                    Payment History
                                                </td>
                                            </tr>
                                            @foreach (@$quote->payments as $payment)
                                                <tr>
                                                    <td class="p-2 fw-medium">Date:</td>
                                                    <td class="p-2">
                                                        {{ \Carbon\Carbon::parse($payment->created_at)->format('d/m/Y') }}
                                                    </td>

                                                    <td class="p-2 fw-medium">Remaining
                                                        Amount:
                                                    </td>
                                                    <td class="p-2">
                                                        {{ number_format($payment->remaining_amount, 2, '.', '') }}
                                                    </td>

                                                    <td class="p-2 fw-medium">Amount Paid:
                                                    </td>
                                                    <td class="p-2">
                                                        {{ number_format($payment->amount_paid, 2, '.', '') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table> --}}
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12 flex-column justify-content-center align-items-center">
                                <p class="mb-0">www.blueworldmaldives.com,
                                    info@blueworldmaldives.com </p>
                                <p> +960 7-606409, +960 795-4444</p>
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
