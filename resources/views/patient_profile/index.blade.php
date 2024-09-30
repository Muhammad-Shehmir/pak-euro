@extends('layout.master')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between py-3">
            <h4 class="fw-bold mb-0"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard / </a><a
                    href="{{ url('client') }}" class="text-muted fw-light">Client </a><span class="color">/
                    Profile
            </h4></span>
            <h4 class="fw-medium">Balance : Rs. {{ number_format(-$balance + $totalSecurityAmount, 2, '.') }}</h4>
        </div>
        <div class="row">
            <!-- User Sidebar -->
            <div class="col-xl-3 col-lg-4 col-md-4 order-1 order-md-0">
                <!-- User Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <img class="rounded mb-3 mt-4" src="https://ui-avatars.com/api/?name={{ $customer->name }}"
                                    height="100" width="120" alt="User avatar" />
                                <div class="user-info text-center">
                                    <h4>{{ $customer->name }}</h4>
                                    <span
                                        class="{{ $customer->type_id == 1 ? 'badge bg-label-success' : 'badge bg-label-primary' }}">{{ $customer->client_type->name ?? 'Client' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="info-container">
                            <ul class="list-unstyled my-4 text-center">
                                <li class="mb-3">
                                    <span class="fw-semibold text-heading">Status:</span>
                                    @if ($customer->status == 1)
                                        <span class="badge bg-label-success">Active</span>
                                    @else
                                        <span class="badge bg-label-danger">InActive</span>
                                    @endif
                                </li>
                                <li class="mb-3">
                                    <span class="fw-semibold text-heading">Whatsapp No. :</span>
                                    <span>{{ $customer->whatsapp_no ?? 'N/A' }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-semibold text-heading">Email:</span>
                                    <span>{{ $customer->email ?? 'N/A' }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-semibold text-heading">Address :</span>
                                    <span class="text-capitalize">{{ $customer->address ?? 'N/A' }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-semibold text-heading">City :</span>
                                    <span class="text-capitalize">{{ $customer->city->name ?? 'N/A' }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-semibold text-heading">Country :</span>
                                    <span class="text-capitalize">{{ $customer->country->name ?? 'N/A' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /User Card -->
            </div>
            <!--/ User Sidebar -->

            <!-- User Content -->
            <div class="col-xl-9 col-lg-8 col-md-8 card order-0 order-md-1">
                <div class="card-header">
                    <div class="nav-align-top">
                        <ul class="nav nav-tabs nav-fill" role="tablist">
                            @if ($customer->type_id == 1)
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#shipment" aria-controls="shipment" aria-selected="true">
                                        <i class="tf-icons mdi mdi-ferry me-1"></i> Shipment
                                    </button>
                                </li>
                            @endif
                            @if ($customer->type_id == 2)
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#finances" aria-controls="finances" aria-selected="false">
                                        <i class="tf-icons mdi mdi-cash-check me-1"></i> Invoice
                                    </button>
                                </li>
                            @endif
                            @if ($customer->type_id == 1)
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#finances" aria-controls="finances" aria-selected="false">
                                        <i class="tf-icons mdi mdi-cash-check me-1"></i> Invoice
                                    </button>
                                </li>
                            @endif
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#family" aria-controls="family" aria-selected="false">
                                    <i class="tf-icons mdi mdi-shield-lock-outline me-1"></i> Security Detail
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#documents" aria-controls="documents" aria-selected="false">
                                    <i class="tf-icons mdi mdi-file-document-alert me-1"></i> Ledger
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#documents-ledger" aria-controls="documents-ledger"
                                    aria-selected="false">
                                    <i class="tf-icons mdi mdi-file-document-alert me-1"></i> Security Detail Ledger
                                </button>
                            </li>
                            {{-- <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#notes" aria-controls="notes" aria-selected="false">
                                    <i class="tf-icons mdi mdi-note-text-outline me-1"></i> Notes
                                </button>
                            </li> --}}
                        </ul>
                    </div>
                </div>
                <div class="card-body profile-card">
                    <div class="tab-content p-0">
                        @if ($customer->type_id == 1)
                            <div class="tab-pane fade active show" id="shipment" role="tabpanel">
                                <div class="d-flex justify-content-end mb-3">
                                    <div class="dt-buttons btn-group flex-wrap">
                                        <a href="{{ url('/shipper/add?client_id=' . $customer->id) }}" type="button"
                                            class="btn btn-primary">
                                            <span><i class="mdi mdi-plus me-sm-1"></i> Add Shipment</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- Shipment content -->
                                <div class="card-body mt-3">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ImCont No</th>
                                                <th>B/L #</th>
                                                <th>Vessel Voy</th>
                                                <th>Delivery Status</th>
                                                {{-- <th>Amount</th> --}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($shipments as $shipment)
                                                <tr>
                                                    <td scope="row">{{ $shipment->imcont_no }}</td>
                                                    <td scope="row">{{ @$shipment->bl_no }}</td>
                                                    <td scope="row">{{ @$shipment->vessel_voy }}</td>
                                                    <td>
                                                        @if ($shipment->delivery_status == 1)
                                                            <span>Delivered</span>
                                                        @elseif ($shipment->delivery_status == 2)
                                                            <span>Pending</span>
                                                        @else
                                                            <span>Rejected</span>
                                                        @endif
                                                    </td>
                                                    {{-- <td>{{ $shipment->carrying_amount }}</td> --}}
                                                    <td> <a class="btn btn-primary me-2 p-2-5"
                                                            href="{{ url('/shipper/edit/' . $shipment->id) }}">Edit
                                                        </a>
                                                        @if ($shipment->transaction)
                                                            <a class="btn btn-success me-2 p-2-5"
                                                                href="{{ url('/invoice/edit/' . $shipment->transaction->id) }}"
                                                                title="Edit Invoice">
                                                                Invoice
                                                            </a>
                                                        @endif

                                                        @if ($shipment->bill)
                                                            <a class="btn btn-warning me-2 p-2-5"
                                                                href="{{ url('/invoice/edit/' . $shipment->bill->id) }}"
                                                                title="Edit Bill">
                                                                Bill
                                                            </a>
                                                        @endif

                                                        <a class="btn btn-danger me-2 p-2-5"
                                                            href="{{ url('/shipper/delete/' . $shipment->id) }}">Delete
                                                        </a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                        <div class="tab-pane fade " id="family" role="tabpanel">
                            <div class="d-flex justify-content-end">
                                <div class="dt-buttons btn-group flex-wrap">
                                    <a href="{{ url('/security-detail/add?client_id=' . $customer->id) }}" type="button"
                                        class="btn btn-primary">
                                        <span><i class="mdi mdi-plus me-sm-1"></i> Add Security Detail</span>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body mt-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($security_details as $security_detail)
                                            <tr>
                                                <td scope="row">{{ @$security_detail->date }}</td>
                                                <td scope="row">{{ @$security_detail->description }}</td>
                                                <td scope="row">{{ @$security_detail->amount }}</td>
                                                <td class="d-flex justify-items-center"> <a class="btn btn-primary me-2 p-2-5"
                                                        href="{{ url('/security-detail/edit/' . $security_detail->id) }}"><i
                                                            class="fa fa-edit"></i>
                                                    </a>
                                                    <form method="post"
                                                        action="{{ url('/security-detail/delete/' . $security_detail->id) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger p-2-5">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- <div class="tab-pane fade" id="family" role="tabpanel">
                            <div class="d-flex justify-content-end">
                                <div class="dt-buttons btn-group flex-wrap">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                        <span><i class="mdi mdi-plus me-sm-1"></i> Add Reciepts</span>
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <!-- Family members content -->
                            </div>
                        </div> --}}
                        @if ($customer->type_id == 2)
                            <div class="tab-pane fade active show" id="finances" role="tabpanel">
                        @endif
                        @if ($customer->type_id == 1)
                            <div class="tab-pane fade" id="finances" role="tabpanel">
                        @endif
                        {{-- <div class="d-flex justify-content-end mb-3">
                            <div class="dt-buttons btn-group flex-wrap">
                                <a href="{{ url('/invoice/add?client_id=' . $customer->id) }}" type="button"
                                    class="btn btn-primary">
                                    <span><i class="mdi mdi-plus me-sm-1"></i> Add Invoice</span>
                                </a>
                            </div>
                        </div> --}}
                        <div class="card h-100 mt-1">
                            {{-- <div class="card-header d-flex align-items-center justify-content-between py-3">
                                <h5 class="card-title m-0 me-2">{{ $customer->type_id == 1 ? 'Invoice' : 'Bill' }} Data : </span></h5>
                                <h5 class="card-title m-0 me-2">Balance: <span class="fw-medium">PKR {{ number_format($balance, 2) ?? '0.00' }}</span></h5>
                            </div> --}}
                            <div class="card-body mt-3">
                                <ul class="p-0 m-0">
                                    <li class="d-flex mb-2 justify-content-between">
                                        <h6 class="mb-0 small">{{ $customer->type_id == 1 ? 'Invoice' : 'Bill' }} NO.</h6>
                                        <h6 class="mb-0 small">AMOUNT</h6>
                                    </li>
                                    @foreach ($transactions as $transaction)
                                        <li class="d-flex mb-2">
                                            <div class="avatar avatar-md flex-shrink-0 me-3">
                                                <div class="avatar-initial bg-lighter rounded">
                                                    <div>
                                                        <i class="text-primary mdi mdi-file-document-outline"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <a href="{{ url('/invoice/preview/' . $transaction->id) }}">
                                                        <h6 class="mb-0">
                                                            {{ $transaction->type_id == 1 ? 'Invoice #' : 'Bill #' }}{{ $transaction->tran_no }}
                                                        </h6>
                                                        <small
                                                            class="text-muted">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y') }}</small>
                                                    </a>
                                                </div>
                                                <div class="badge bg-label-primary rounded-pill">
                                                    {{ $transaction->total_amount }}</div>
                                                @if ($transaction->status == 1)
                                                <div class="d-flex align-items-center">
                                                    <a class="btn btn-primary me-2 p-2-5"
                                                        href="{{ url('/invoice/edit/' . $transaction->id) }}"><i
                                                            class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-primary me-2 p-2-5"
                                                        href="{{ url('/invoice/delete/' . $transaction->id) }}"><i
                                                            class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="documents" role="tabpanel">
                        <div class="d-flex justify-content-end">
                            <div class="dt-buttons btn-group flex-wrap">
                                <a href="{{ url('client-ledger/' . $customer->id) }}" target="_blank"
                                    class="btn btn-secondary create-new btn-primary" type="button"><span><i
                                            class="mdi mdi-file me-sm-1"></i>
                                        <span class="d-none d-sm-inline-block">PDF</span></span></a>
                            </div>
                            <div class="dt-buttons btn-group flex-wrap">
                                <a href="{{ url('export-ledger') }}" class="btn btn-secondary create-new btn-primary"
                                    type="button"><span><i class="mdi mdi-microsoft-excel me-sm-1"></i>
                                        <span class="d-none d-sm-inline-block">Excel</span></span></a>
                            </div>
                        </div>
                        <div class="card-body p-0 mt-3">
                            <div class="card-header d-flex align-items-center justify-content-between py-3">
                                {{-- <h5 class="card-title m-0 me-2">Total Received :
                                        <span
                                            class="fw-medium">{{ 'PKR ' . number_format($totalReceipts, 2) ?? '0.00' }}</span>
                                    </h5>
                                    <h5 class="card-title m-0 me-2">Total Paid :
                                        <span
                                            class="fw-medium">{{ 'PKR ' . number_format($totalPayments, 2) ?? '0.00' }}</span>
                                    </h5> --}}
                                {{-- <h5 class="card-title m-0 me-2">Balance:
                                        <span class="fw-medium">{{ number_format($balance, 2) ?? '0.00' }}
                                        </span>
                                    </h5> --}}
                            </div>
                            @if ($customer->type_id == 1)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            {{-- <th>S.No</th> --}}
                                            <th>Date</th>
                                            <th>Container No</th>
                                            <th>Delivery Status</th>
                                            <th>Delivery Party</th>
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
                                                <td scope="row">
                                                    {{ number_format($shipment->carrying_rate, 2) ?? '0.00' }}</td>
                                                <td scope="row">{{ number_format($shipment->quantity, 2) ?? '0.00' }}
                                                </td>
                                                <td scope="row">
                                                    {{ number_format($shipment->transaction->total_amount, 2) ?? '0.00' }}
                                                </td>
                                                {{-- <td scope="row">{{ number_format($shipment->transaction->total_amount, 2) ?? '0.00' }}</td> --}}
                                                {{-- <td scope="row">
                                                    {{ \Carbon\Carbon::parse($shipment->transaction->date)->format('d-F-Y') ?? '' }}
                                                </td> --}}
                                                <td scope="row">
                                                    {{ @$shipment->eway_bill . ' / ' . @$shipment->invoice_no }}</td>

                                                @php
                                                    $totalPaidAmount = 0;
                                                @endphp

                                                @if (isset($shipment->transaction) && $shipment->transaction->payments->isNotEmpty())
                                                    @foreach ($shipment->transaction->payments as $payment)
                                                        @php
                                                            $totalPaidAmount += $payment->amount_paid;
                                                        @endphp
                                                    @endforeach
                                                @endif

                                                <td scope="row">{{ number_format($totalPaidAmount, 2) }}</td>
                                            </tr>
                                            @php
                                                $totalDebit += $shipment->transaction->total_amount;
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
                            @elseif($customer->type_id == 2)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            {{-- <th>S.No</th> --}}
                                            <th>Date</th>
                                            <th>Container No</th>
                                            <th>Delivery Status</th>
                                            <th>Delivery Party</th>
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
                                                <td scope="row">
                                                    {{ number_format($shipment->rate, 2) ?? '0.00' }}</td>
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
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="documents-ledger" role="tabpanel">
                        <div class="d-flex justify-content-end">
                            <div class="dt-buttons btn-group flex-wrap">
                                <a href="{{ url('sec-ledger/' . $customer->id) }}" target="_blank"
                                    class="btn btn-secondary create-new btn-primary" type="button"><span><i
                                            class="mdi mdi-file me-sm-1"></i>
                                        <span class="d-none d-sm-inline-block">PDF</span></span></a>
                            </div>
                            <div class="dt-buttons btn-group flex-wrap">
                                <a href="{{ url('pd-security-ledger') }}"
                                    class="btn btn-secondary create-new btn-primary" type="button"><span><i
                                            class="mdi mdi-microsoft-excel me-sm-1"></i>
                                        <span class="d-none d-sm-inline-block">Excel</span></span></a>
                            </div>
                        </div>
                        <div class="card-body mt-3">
                            <div class="card-header d-flex align-items-center justify-content-between py-3">
                                <h5 class="card-title m-0 me-2">Total :
                                    <span class="fw-medium">{{ number_format($totalSecurityAmount, 2) ?? '0.00' }}</span>
                                </h5>
                                {{-- <h5 class="card-title m-0 me-2">Total Paid :
                                        <span
                                            class="fw-medium">{{ 'PKR ' . number_format($totalPayments, 2) ?? '0.00' }}</span>
                                    </h5>
                                    <h5 class="card-title m-0 me-2">Balance:
                                        <span class="fw-medium">{{ number_format($balance, 2) ?? '0.00' }}
                                        </span>
                                    </h5> --}}
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Token</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($security_details as $index => $security_detail)
                                        <tr>
                                            <td scope="row">
                                                {{ $security_detail->date ? \Carbon\Carbon::parse($security_detail->date)->format('d-F-Y') : '' }}
                                            </td>
                                            <td scope="row">
                                                {{ $security_detail->description ?? '---' }}
                                            </td>
                                            <td scope="row">
                                                {{ $security_detail->token ?? '---' }}
                                            </td>
                                            <td scope="row">
                                                @if ($security_detail->type_id == 1)
                                                    {{ number_format($security_detail->amount, 2) ?? '0.00' }}
                                                @else
                                                    {{ number_format(-$security_detail->amount, 2) ?? '0.00' }}
                                                @endif
                                            </td>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td scope="row fw-bold" colspan="3">Total</td>
                                        <td scope="row fw-bold">
                                            {{ number_format($totalSecurityAmount, 2) ?? '0.00' }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="tab-pane fade" id="documents" role="tabpanel">
                            <div class="d-flex justify-content-end">
                                <div class="dt-buttons btn-group flex-wrap">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalCenters" class="btn btn-primary">
                                        <span><i class="mdi mdi-plus me-sm-1"></i> Add Documents</span>
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="card-datatable table-responsive pt-0 p-3">
                                    <table class="datatables-basic table table-bordered">
                                        <thead>
                                            <tr>
                                                <th><h6>S No.</h6></th>
                                                <th><h6>Name</h6></th>
                                                <th><h6>Date Of Birth</h6></th>
                                                <th><h6>Passport No</h6></th>
                                                <th><h6>Actions</h6></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customerdocument as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->dob)->format('d/M/Y') }}</td>
                                                    <td>{{ $item->passport_number }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a class="btn btn-primary me-2 p-2-5" href="{{ url('/edit-documents/' . $customer->id . '/' . $item->id) }}">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <form method="post" class="d-flex align-items-center mb-0" action="{{ url('/delete-documents/' . $customer->id . '/' . $item->id) }}">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger p-2-5">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> --}}
                    <div class="tab-pane fade" id="notes" role="tabpanel">
                        <div class="d-flex justify-content-end">
                            <div class="dt-buttons btn-group flex-wrap">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#NotesModal"
                                    class="btn btn-primary">
                                    <span><i class="mdi mdi-plus me-sm-1"></i> Add Notes</span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($notes as $note)
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex flex-column">
                                                    <div>
                                                        <i class="mdi mdi-account-outline"></i><span
                                                            class="fw-semibold fs-6 mx-1">Added By:</span>
                                                        <span>{{ $note->added_by->name }}</span>
                                                    </div>
                                                    <div>
                                                        <i class="mdi mdi-clock-outline"></i><span
                                                            class="fw-semibold fs-6 mx-1">Added On:</span>
                                                        <span class="fs-7">{!! \Carbon\Carbon::parse($note->created_at)->format('d M y, h:i A') !!}</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end">
                                                    <form method="post"
                                                        action="{{ url('/notes/delete/' . $note->id) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger h-px-40 p-2-5">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body fancybox">
                                            <div
                                                class="d-flex align-items-start align-items-sm-center gap-4 pb-2 overflow-auto">
                                                @foreach ($note->notes as $report)
                                                    @php
                                                        $extension = pathinfo($report, PATHINFO_EXTENSION);
                                                    @endphp
                                                    @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                        <img src="{{ url('/uploads/notes/' . $report) }}"
                                                            data-fancybox="gallery-notes" alt="notes"
                                                            class="d-block w-px-120 h-px-100 rounded-1 cursor-pointer"
                                                            id="uploadedAvatar" />
                                                    @elseif (in_array($extension, ['pdf']))
                                                        <embed src="{{ url('/uploads/notes/' . $report) }}"
                                                            class="d-block w-px-120 h-px-100 rounded-1 cursor-pointer"
                                                            data-fancybox="gallery-notes" type="application/pdf"
                                                            width="50%" height="100px" />
                                                    @else
                                                        <a href="{{ url('/uploads/notes/' . $report) }}"
                                                            target="_blank">{{ $report }}</a>
                                                    @endif
                                                @endforeach
                                            </div>
                                            @if ($note->description)
                                                <div class="pt-3">
                                                    <span class="fw-semibold fs-6 ">Description:</span>
                                                    <p class="fs-7">{{ $note->description }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ User Content -->
    </div>

    <!--/ Content -->

    @include('patient_profile.modals.add_family')
    @include('patient_profile.modals.add_document')
    @include('patient_profile.modals.add_arrival_departure')
    @include('patient_profile.modals.add_notes')

    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const section = urlParams.get('section');

            if (section === 'receipt') {
                const familyTabButton = document.querySelector('[data-bs-target="#family"]');
                const bootstrapTab = new bootstrap.Tab(familyTabButton);
                bootstrapTab.show();

                // Scroll to the section
                document.getElementById('family').scrollIntoView();
            } else if (section == 'finances') {
                const financesTabButton = document.querySelector('[data-bs-target="#finances"]');
                const bootstrapTab = new bootstrap.Tab(financesTabButton);
                bootstrapTab.show();

                document.getElementById('finances').scrollIntoView();
            }
        });
        $(document).ready(function() {
            $('.flight_no').hide()
            $('.departure_flight_no').hide()
            $('.boat_name').hide()

            $('#arrival_type').change(function() {
                var value = $(this).val();

                if (value == 1) {
                    $('.flight_no').hide()
                    $('.departure_flight_no').hide()
                    $('.boat_name').hide()
                } else if (value == 2) {
                    $('.flight_no').show()
                    $('.departure_flight_no').show()
                    $('.boat_name').hide()
                } else if (value == 3) {
                    $('.flight_no').hide()
                    $('.departure_flight_no').hide()
                    $('.boat_name').show()
                }
            })
        })
    </script>
    {{-- <script>
    $(document).ready(function() {
        // Select the input fields and the result field
        var $charges = $("#charges");
        var $discount = $("#discount");
        var $tax = $("#tax");
        var $share = $("#share");
        var $amount = $("#amount");
        
        // Listen for changes in the input fields
        $charges.on("input", calculateTotalAmount);
        $discount.on("input", calculateTotalAmount);
        $tax.on("input", calculateTotalAmount);
        $share.on("input", calculateTotalAmount);
        
        // Function to calculate the total amount
        function calculateTotalAmount() {
            // Parse values and ensure they are numeric
            var charges = parseFloat($charges.val()) || 0;
            var discountPercentage = parseFloat($discount.val()) || 0;
            var taxPercentage = parseFloat($tax.val()) || 0;
            var sharePercentage = parseFloat($share.val()) || 0;
            
            // Calculate amounts
            var discountAmount = (discountPercentage / 100) * charges;
            var taxAmount = (taxPercentage / 100) * charges;
            var shareAmount = (sharePercentage / 100) * charges;
            
            // Calculate total amount
            var amount = charges - discountAmount + taxAmount - shareAmount;
            
            // Update the total amount field
            $amount.val(amount.toFixed(2)); // Display with 2 decimal places
        }
        
        function validateDiseases() {
            var atLeastOneChecked = $('input[name="diseases[]"]:checked').length > 0;
            return atLeastOneChecked;
        }
        
        $('#dental-quadrant-form').submit(function(e) {
            // Check diseases validation before form submission
            if ($('input[name="teeth_no[]"]:checked').length === 0) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Please Select Teeth!',
                    showConfirmButton: false,
                    timer: 2500
                })
                e.preventDefault(); // Prevent form submission
            } else if (!validateDiseases()) {
                // Display an error message or perform any other action
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Please Select Diseases!',
                    showConfirmButton: false,
                    timer: 2500
                })
                e.preventDefault(); // Prevent form submission
            }
        });
        
        $('input[name="teeth_no[]"]').change(function() {
            // Get the teeth_no of the selected checkbox
            var teethNo = $(this).closest('.tooth-container').find('p.teeth').text().trim();
            var toothIcon = $(this).closest('.tooth-container').find('.mdi-tooth-outline');
            toothIcon.removeClass('mdi-tooth-outline').addClass('mdi-tooth');
            
            // Check if the checkbox is checked
            if ($(this).is(':checked')) {
                // Checkbox is checked, perform the AJAX request
                $.ajax({
                    type: "POST",
                    data: {
                        "id": {{ $customer->id }},
                        "teeth_no": teethNo
                    },
                    url: "{{ url('api/dentalQuadrant/getById') }}",
                    dataType: 'json',
                    success: function(result) {
                        var data = result.data;
                        if (data !== null && data.length > 0) {
                            data.forEach(function(entry) {
                                var checkboxId = 'disease-' + entry.disease_id;
                                $('#' + checkboxId).prop('checked', true);
                            });
                        } else {
                            // If data is null or empty, uncheck all disease checkboxes
                            $('input[name="diseases[]"]').prop('checked', false);
                        }
                    }
                });
            } else {
                // Checkbox is unchecked, uncheck all disease checkboxes
                $('input[name="diseases[]"]').prop('checked', false);
                var toothIcon = $(this).closest('.tooth-container').find('.mdi-tooth');
                toothIcon.removeClass('mdi-tooth').addClass('mdi-tooth-outline');
            }
        });
        
        const modalButtons = $('.treatment-modal');
        
        // Add a click event listener to each modal button
        modalButtons.each(function() {
            $(this).on('click', function() {
                // Get the treatment plan ID from the data attribute
                const planId = $(this).data('plan-id');
                
                // Update the hidden input value in the modal
                $('#treatmentPlanId').val(planId);
            });
        });
    });
    // Initially hide the textarea when the page loads
    document.addEventListener("DOMContentLoaded", function() {
        var procedureDetailsTextarea = document.getElementById("procedureDetails");
        procedureDetailsTextarea.style.display = 'none';
    });
    
    function getProcedureId() {
        var select = document.getElementById("procedure_id");
        var selectedOptions = select.selectedOptions;
        
        // Check if any procedure is selected
        var isProcedureSelected = selectedOptions.length > 0;
        
        // Initialize variables to store the total charges and create a variable to store procedure details
        var totalCharges = 0;
        var totalAmount = 0;
        var procedureDetails = '';
        
        // Iterate through selected options
        for (var i = 0; i < selectedOptions.length; i++) {
            var selectedProcedure = selectedOptions[i].value;
            
            // Make an Ajax request for each selected procedure
            $.ajax({
                type: "POST",
                data: {
                    "procedure_id": selectedProcedure,
                },
                url: "{{ url('api/procedure/getById') }}",
                dataType: 'json',
                async: false, // Wait for each request to complete
                success: function(result) {
                    var data = result.data;
                    var charges = parseFloat(data.price) || 0;
                    
                    // Accumulate charges and amounts
                    totalCharges += charges;
                    totalAmount += charges;
                    
                    // Build the procedure details string
                    // procedureDetails += data.name + ': Rs' + charges.toFixed(2) + '\n';
                }
            });
        }
        
        // Update the input fields with the accumulated values
        var chargesInput = document.getElementById("charges");
        var amountInput = document.getElementById("amount");
        // var procedureDetailsTextarea = document.getElementById("procedureDetails");
        
        chargesInput.value = totalCharges.toFixed(2);
        amountInput.value = totalAmount.toFixed(2);
        
        // Display or hide the textarea based on whether a procedure is selected
        // if (isProcedureSelected) {
        //     procedureDetailsTextarea.value = procedureDetails;
        //     procedureDetailsTextarea.style.display = 'block'; // Show the textarea
        // } else {
            //     procedureDetailsTextarea.value = ''; // Clear the textarea content
            //     procedureDetailsTextarea.style.display = 'none'; // Hide the textarea
            // }
        }
    </script> --}}
@endsection
