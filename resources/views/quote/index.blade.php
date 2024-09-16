@extends('layout.master')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center p-3 py-0">
            <h4 class="fw-bold py-3 mb-2"><a href="{{ url('dashboard') }}" class="text-muted fw-light">Dashboard </a><span
                    class="color">/ Quote
            </h4></span>
            <button class="btn btn-secondary create-new btn-primary" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" tabindex="0"
                aria-controls="DataTables_Table_0" type="button"><span><i class="mdi mdi-filter-outline me-sm-1"></i>
                    <span class="d-none d-sm-inline-block">Filters</span></span></button>
        </div>


        <div class="card-body">


            <div class="col-20">

                <div class="card mb-4">


                    <div class="collapse" id="collapseExample">
                        <div class="d-grid p-3 border">
                            <form method="GET" id="myForm" action="{{ url('/quote') }}" enctype="multipart/form-data"
                                id="formValidationExamples" class="row g-3">
                                @csrf
                                <div class="col-md-7">
                                    <div class="input-group input-group-merge mb-2">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="mdi mdi-account-outline"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" required class="form-control name-validate"
                                                value="{{ request('name') }}" id="basic-icon-default-fullname"
                                                placeholder="Enter Name" name="name" aria-label="Enter Name"
                                                aria-describedby="basic-icon-default-fullname2" />
                                            <label for="basic-icon-default-fullname"> Name</label>
                                        </div>
                                    </div>
                                    <span class="text-danger validation-name" style="display: none;">
                                        <i class="mdi mdi-alert"></i> Name is invalid
                                    </span>
                                </div>

                                {{-- <div class="col-md-7"> --}}


                                <div class="d-flex justify-content-end  p-1 py-1">
                                    <button class="btn btn-secondary create-new btn-primary" tabindex="0"
                                        type="submit"><span><i class="mdi mdi-magnify"></i>
                                            <span class="d-none d-sm-inline-block">Search</span></span></button>
                                    <a href="{{ url('/quote') }}" class="btn btn-danger" tabindex="0"><span><i
                                                class="mdi mdi-close"></i>
                                            <span class="d-none d-sm-inline-block">Clear</span></span></a>
                                    {{-- </div> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-header flex-column flex-md-row">
                <div class="head-label text-center">
                </div>
                <div class="dt-action-buttons  pt-3 pt-md-0">
                    <div class="dt-buttons btn-group flex-wrap">
                        <a href="{{ url('/quote/add') }}" class="btn btn-secondary create-new btn-primary" tabindex="0"
                            aria-controls="DataTables_Table_0" type="button"><span><i class="mdi mdi-plus me-sm-1"></i>
                                <span class="d-none d-sm-inline-block">Add New</span></span></a>
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive pt-0 p-3">
                <table class="datatables-basic table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <h6>ID</h6>
                            </th>
                            <th>
                                <h6>Customer Name</h6>
                            </th>
                            <th>
                                <h6>Total Converted Amount</h6>
                            </th>
                            <th>
                                <h6>Total Amount</h6>
                            </th>
                            <th>
                                <h6>Created At</h6>
                            </th>
                            <th>
                                <h6>Actions</h6>
                            </th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quotes as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ optional($item->customer)->name }}</td>
                                <td>{{ $item->currency->name . ' ' . $item->total_converted_amount }}</td>
                                <td>{{ '$ ' . $item->total_amount }}</td>
                                <td>{{ Carbon\Carbon::parse($item->created_at)->format('d/M/Y') }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a target="_blank" class="btn btn-success me-2 p-2-5"
                                            href="{{ url('/quote/preview' . '/' . $item->id) }}" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Preview"><i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a class="btn btn-primary me-2 p-2-5"
                                            href="{{ url('/quote/edit/' . $item->id) }}" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Edit"><i class="fa fa-edit"></i>
                                        </a>
                                        <a target="_blank" class="btn btn-success me-2 p-2-5"
                                            href="{{ url('/travel/pdf/' . $item->id) }}" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Travel Voucher">
                                            <i class="mdi mdi-file-pdf-box"></i>
                                        </a>
                                        {{-- <a target="_blank" class="btn btn-info me-2 p-2-5"
                                            href="#"><i
                                                class="mdi  mdi-file-document-outline"></i>
                                                {{-- Invoice --}}
                                        {{-- </a> --}}
                                        <a target="_blank" class="btn btn-info me-2 p-2-5 invoice-button"
                                            href="{{ url('/invoices/create-from-quote/' . $item->id) }}"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Invoice">
                                            <i class="mdi mdi-file-document-outline"></i>
                                        </a>
                                        {{-- <form id="invoice-form" action="/invoices/create-from-quote" method="POST">
                                            @csrf
                                            <input type="hidden" name="quote_id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-info me-2 mt-3 p-2-5 invoice-button">
                                                <i class="mdi mdi-file-document-outline"></i>
                                            </button>
                                        </form> --}}
                                        {{-- @if ($item->quote_detail->contains('product_category_id', 1))
                                            @foreach ($item->quote_detail->where('product_id') as $detail)
                                                <form id="invoice-form" action="/booking/create-from-quote" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="quote_id" value="{{ $item->id }}">
                                                    <input type="hidden" name="product_id" value="{{ $detail->product_id }}">
                                                    <button type="submit" class="btn btn-warning me-2 mt-3 p-2-5 booking-button" style="font-size: 14px"> --}}
                                        {{-- <i class="mdi mdi-clock-plus-outline"></i>  --}}
                                        {{-- Book {{$detail->product->name}}
                                                    </button>
                                                </form>
                                            @endforeach    
                                        @endif --}}
                                        {{-- @if ($item->quote_detail->contains('product_category_id', 1))
                                            <form id="invoice-form" action="/booking/create-from-quote" method="POST" class="d-flex align-items-center">
                                                @csrf
                                                <input type="hidden" name="quote_id" value="{{ $item->id }}">
                                                <select name="product_id" class="form-select mt-3">
                                                    @foreach ($item->quote_detail->where('product_id') as $detail)
                                                        <option value="{{ $detail->product_id }}">{{ $detail->product->name }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-warning p-2-5 mt-3"><i class="mdi mdi-clock-plus-outline"></i></button>
                                            </form>
                                        @endif --}}
                                        @if ($item->quote_detail->contains('product_category_id', 1))
                                            <form id="booking-form" action="/booking/create-from-quote" method="POST"
                                                class="d-flex align-items-center">
                                                @csrf
                                                <input type="hidden" id="selected_product_id" name="product_id">
                                                <!-- Single hidden input for selected product_id -->
                                                {{-- <input type="hidden" name="quote_id" value="{{ $item->id }}"> --}}
                                                <input type="hidden" name="quote_id" id="selected_quote_id"
                                                    {{-- value="{{ $detail->quote_id }}" --}}>
                                                <div class="dropdown" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Booking">
                                                    <button type="button"
                                                        class="btn btn-warning dropdown-toggle me-2 mt-3 p-2-5"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-clock-plus-outline"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @foreach ($item->quote_detail->where('product_category_id', 1) as $detail)
                                                            <li>
                                                                <button class="dropdown-item" type="button"
                                                                    onclick="selectProduct('{{ $detail->product_id }}', '{{ $detail->product->name }}', '{{ $detail->quote_id }}')">{{ $detail->product->name }}</button>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <div class="mb-3">
                    <select id="perPage" name="perPage" class="form-select" onchange="changePerPage(this)">
                        <option value="5" @if ($perPage == 5) selected @endif>5</option>
                        <option value="10" @if ($perPage == 10) selected @endif>10</option>
                        <option value="15" @if ($perPage == 15) selected @endif>15</option>
                        <option value="25" @if ($perPage == 25) selected @endif>25</option>
                    </select>
                    <label for="perPage" class="form-label">Items per page:</label>

                </div>
                {{ $quotes->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
<script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script>
    function changePerPage(select) {
        const perPage = select.value;
        window.location.href = `{{ url('quote') }}?perPage=${perPage}`;
    }

    function selectProduct(productId, productName, quoteId) {
        // Set the selected product_id in the hidden input field
        document.getElementById('selected_product_id').value = productId;
        document.getElementById('selected_quote_id').value = quoteId;

        // Change the dropdown button text to the selected product name
        document.querySelector('.btn.dropdown-toggle').innerHTML =
            `<i class="mdi mdi-clock-plus-outline"></i>${productName}`;

        // Submit the form
        document.getElementById('booking-form').submit();
    }
</script>
