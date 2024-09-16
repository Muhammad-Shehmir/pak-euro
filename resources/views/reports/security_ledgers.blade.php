@extends('layout.master')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center p-3 py-0">
            <h4 class="fw-bold py-3 mb-2"><a href="{{ url('dashboard') }}" class="text-muted fw-light">Dashboard /
                    Reports </a><span class="color">/ Security Detail Ledgers
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
                        <form method="GET" id="myForm" action="{{ url('/security-detail-reports') }}"
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
                                <p class="mb-2">Client Name</p>
                                <select multiple id="client_id" name="client_id[]" type="text"
                                    class="select2 form-select form-select-lg" data-allow-clear="true">
                                    <option value="">Select</option>
                                    @foreach ($clients as $client)
                                        <option {{ in_array($client->id, request()->client_id ?? []) ? 'selected' : '' }}
                                            value="{{ $client->id }}">
                                            {{ $client->name }}
                                        </option>
                                    @endforeach
                                </select>

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
                                <a href="{{ url('/security-detail-reports') }}" class="btn btn-danger" tabindex="0"><span><i
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
                            <th>Date</th>
                            <th>Type</th>
                            <th>Client</th>
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
                                    {{ $security_detail->type == 1 ? 'Receipt' : 'Payment' }}
                                </td>
                                <td scope="row">
                                    {{ $security_detail->client->name ?? '---' }}
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
                            <td scope="row fw-bold" colspan="5">Total</td>
                            <td scope="row fw-bold">
                                {{ number_format($totalSecurityAmount, 2) ?? '0.00' }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
