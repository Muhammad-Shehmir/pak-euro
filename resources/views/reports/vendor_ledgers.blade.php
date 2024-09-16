@extends('layout.master')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center p-3 py-0">
            <h4 class="fw-bold py-3 mb-2"><a href="{{ url('dashboard') }}" class="text-muted fw-light">Dashboard /
                    Reports </a><span class="color">/ Ledgers
            </h4></span>
            <div class="">
                {{-- <a href="{{ url('export-finances') . '?' . http_build_query(['date_from' => request()->date_from, 'date_to' => request()->date_to]) }}"
                    class="btn btn-secondary create-new btn-primary" type="button"><span><i
                            class="mdi mdi-microsoft-excel me-sm-1"></i>
                        <span class="d-none d-sm-inline-block">Ledgers Report</span></span></a> --}}
                <button class="btn btn-secondary create-new btn-primary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" tabindex="0"
                    aria-controls="DataTables_Table_0" type="button"><span><i class="mdi mdi-filter-outline me-sm-1"></i>
                        <span class="d-none d-sm-inline-block">Filters</span></span></button>
            </div>
        </div>


        <div class="card-body">
            <div class="card mb-2 w-100">
                <div class="collapse" id="collapseExample">
                    <div class="d-grid p-3 border">
                        <form method="GET" id="myForm" action="{{ url('/vendor-ledger-reports') }}"
                            enctype="multipart/form-data" id="formValidationExamples" class="row align-items-center g-3">
                            @csrf
                            <div class="col-md-3">
                                <div class="input-group input-group-merge">
                                    <span id="dateTime" class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" class="form-control" id="date_from" name="date_from"
                                            placeholder="Date From" value="{{ request('date_from') }}" />
                                        <label for="date_from">Date From</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group input-group-merge">
                                    <span id="dateTime" class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" class="form-control" id="date_to" name="date_to"
                                            placeholder="Date To" value="{{ request('date_to') }}" />
                                        <label for="date_to">Date To</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <p class="mb-2">Vendor Name</p>
                                <select id="vendor_id" multiple name="vendor_id[]" type="text"
                                    class="select2 form-select form-select-lg" data-allow-clear="true">
                                    <option value="">Select</option>
                                    @foreach ($vendors as $vendor)
                                        <option {{ in_array($vendor->id, request()->vendor_id ?? []) ? 'selected' : '' }}
                                            value="{{ $vendor->id }}">
                                            {{ $vendor->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex justify-content-end p-3 py-0">
                                <button class="btn btn-secondary create-new btn-primary" tabindex="0"
                                    type="submit"><span><i class="mdi mdi-magnify"></i>
                                        <span class="d-none d-sm-inline-block">Search</span></span></button>
                                <a href="{{ url('/vendor-ledger-reports') }}" class="btn btn-danger" tabindex="0"><span><i
                                            class="mdi mdi-close"></i>
                                        <span class="d-none d-sm-inline-block">Clear</span></span></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-datatable table-responsive p-3">
                <table class="datatables-basic table table-bordered">
                    <thead>
                        <tr>
                            {{-- <th>S.No</th> --}}
                            <th>Date</th>
                            <th>Container No</th>
                            <th>Delivery Status</th>
                            <th>Delivery Party</th>
                            <th>Vendor Name</th>
                            <th>Rate</th>
                            <th>Weight</th>
                            <th>Debit</th>
                            {{-- <th>Transport Charge</th> --}}
                            {{-- <th>Date</th> --}}
                            <th>EWAYBILL / INVC #</th>
                            <th>Credit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalDebit = 0;
                            $totalCredit = 0;
                        @endphp
                        @foreach ($shipments as $index => $shipment)
                            <tr>
                                {{-- <td scope="row">{{ $index }}</td> --}}
                                <td scope="row">
                                    {{ $shipment->date ? \Carbon\Carbon::parse($shipment->date)->format('d-F-Y') : '' }}
                                </td>
                                <td scope="row">{{ $shipment->imcont_no ?? '---' }}</td>
                                <td scope="row">
                                    @if ($shipment->delivery_status == 1)
                                        <span>Delivered</span>
                                    @elseif ($shipment->delivery_status == 2)
                                        <span>Pending</span>
                                    @else
                                        <span>Rejected</span>
                                    @endif
                                </td>
                                <td scope="row">{{ $shipment->delivery_party ?? '---' }}</td>
                                <td scope="row">{{ $shipment->vendor->name ?? '---' }}</td>
                                <td scope="row">
                                    {{ number_format($shipment->carrying_rate, 2) ?? '0.00' }}</td>
                                <td scope="row">{{ number_format($shipment->quantity, 2) ?? '0.00' }}
                                </td>
                                <td scope="row">
                                    {{ number_format($shipment->bill->total_amount, 2) ?? '0.00' }}
                                </td>
                                {{-- <td scope="row">{{ number_format($shipment->bill->total_amount, 2) ?? '0.00' }}</td> --}}
                                {{-- <td scope="row">
                                        {{ \Carbon\Carbon::parse($shipment->bill->date)->format('d-F-Y') ?? '' }}
                                    </td> --}}
                                <td scope="row">
                                    {{ @$shipment->eway_bill . ' / ' . @$shipment->invoice_no }}</td>

                                @php
                                    $totalPaidAmount = 0;
                                @endphp

                                @if (isset($shipment->bill) && $shipment->bill->payments->isNotEmpty())
                                    @foreach ($shipment->bill->payments as $payment)
                                        @php
                                            $totalPaidAmount += $payment->amount_paid;
                                        @endphp
                                    @endforeach
                                @endif

                                <td scope="row">{{ number_format($totalPaidAmount, 2) }}</td>
                            </tr>
                            @php
                                $totalDebit += $shipment->bill->total_amount;
                                $totalCredit += $totalPaidAmount;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td scope="row fw-bold" colspan="6">Total</td>
                            <td scope="row fw-bold" colspan="2">
                                {{ number_format($totalDebit, 2) ?? '0.00' }}</td>
                            <td scope="row fw-bold">
                                {{ number_format($totalCredit, 2) ?? '0.00' }}</td>
                        </tr>
                        <tr>
                            <td scope="row fw-bold" colspan="8">Total Balance Recievable / Payable</td>
                            <td scope="row fw-bold" colspan="3">
                                {{ number_format($totalDebit - $totalCredit, 2) ?? '0.00' }}</td>
                            {{-- <td scope="row fw-bold">
                                    {{ number_format($totalCredit, 2) ?? '0.00' }}</td> --}}
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
