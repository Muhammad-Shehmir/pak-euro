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
        }

        .invoice-preview {
            width: 100%;
            position: absolute;
            left: 1%;
            top: 5%;
        }

    }
</style>
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center p-3 py-0">
            <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a
                    href="{{ url('/invoice') }}" class="text-muted fw-light">/ Invoice</a><span class="color"> /</span><span
                    class="text-heading fw-bold text-color"> Preview</span>
            </h4>
        </div>

        <div class="row invoice-preview">
            <!-- Invoice Actions -->
            <div class="col-xl-12 col-md-4 mb-3 invoice-actions">
                <div class="card">
                    <div class="card-body d-flex justify-content-evenly">
                        <a href="https://api.whatsapp.com/send?phone=+92 {{ $transaction->customer ? $transaction->customer->whatsapp_no : $transaction->customer->phone_no }}&text=Hello%21%20{{ $transaction->customer->name }}."
                            target="_blank" class="btn btn-primary d-grid w-100 mx-3">
                            <span class="d-flex align-items-center text-white justify-content-center text-nowrap"><i
                                    class="mdi mdi-send-outline scaleX-n1-rtl me-1"></i>Send Invoice</span>
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
                    <div class="card-body">
                        <div style="display: flex; justify-content:space-between;" class="">
                            <div class="mb-xl-0 pb-3">
                                <img src="{{ url('/blue-logo.png') }}" width="150" height="40px"
                                    class=" mb-4  app-brand-text fw-bold">
                                {{-- <h4>PATEL DENTAL CLINIC</h4>
                                <p class="mb-1"><i class="mdi mdi-map-marker me-2"></i>Suite#7, 128-U Mono tower, Allama
                                </p>

                                <p class="mb-1"><i class="me-4" style="padding-left: 3px"></i>Iqbal off Tariq Road,
                                    PECHS Block
                                    2</p>
                                <p class="mb-0"><i class="mdi mdi-phone me-2"></i>02134555141, 03219257079</p> --}}
                            </div>
                            <div class="mt-3">
                                <h5 class="mb-1">INVOICE # {{ $transaction->id }}</h5>
                                <div class="mb-4">
                                    <span class="fw-medium">Date :</span>
                                    <span>{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</span>
                                </div>
                                <h6 class="mb-1">Bill To:</h6>
                                <table>

                                    <tbody>
                                        <tr>
                                            <td class="pe-3 fw-medium">Name:</td>
                                            <td>{{ $transaction->customer->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3 fw-medium">Phone No:</td>
                                            <td>{{ $transaction->customer->phone_no }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3 fw-medium">Gender:</td>
                                            <td>{{ $transaction->customer->gender }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-2">
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
                                    {{-- <th>Converted Amount</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction->transaction_detail as $index => $item)
                                    <tr>
                                        <td class="">{{ $index + 1 }}</td>
                                        <td class="">{{ $item->product->name }}</td>
                                        {{-- <td class="">{{ number_format($item->charges, 2, '.', '') }}</td> --}}
                                        <td class="">{{ $item->quantity }}</td>
                                        {{-- <td class="">{{ $item->discount ?? 0 }}%</td>
                                        <td class="">{{ $item->tax ?? 0 }}%</td> --}}
                                        {{-- <td class="">{{ $item->amount }}</td> --}}
                                        <td class="">{{ $item->converted_amount }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between ms-2 flex-row mt-3">
                            <table class="me-2">
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
                            <table class="me-2">
                                <tbody>
                                    <tr>
                                        <td class="pe-3 fw-medium">Sub Total:</td>
                                        <td>Rs. {{ $transaction->sub_total }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pe-3 fw-medium">Discount:</td>
                                        <td>Rs. {{ $transaction->total_discount_amount ?? 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pe-3 fw-medium">Tax:</td>
                                        <td>Rs. {{ $transaction->total_tax_amount ?? 0 }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td class="pe-3 fw-medium">Total Amount:</td>
                                        <td>Rs. {{ $transaction->total_amount }}</td>
                                    </tr> --}}
                                    <tr>
                                        <td class="pe-3 fw-medium">Total Converted Amount:</td>
                                        <td>Rs. {{ $transaction->total_converted_amount }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                {{-- <span class="fw-bold">Note:</span>
                                <span>It was a pleasure working with you and your team. We hope you will keep us in mind for
                                    future freelance projects. Thank You!</span> --}}
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
                                    <h6>Amount Paid</h6>
                                </th>
                                <th>
                                    <h6>Remaining Amount</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (@$transaction->payments as $payment)
                                <tr>
                                    <td>
                                        {{-- {{ $payment->created_at }} --}}
                                        {{ \Carbon\Carbon::parse($payment->created_at)->format('d/M/Y') }}
                                    </td>
                                    <td>{{ number_format($payment->amount_paid, 2, '.', '') }}</td>
                                    <td>{{ number_format($payment->remaining_amount, 2, '.', '') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
