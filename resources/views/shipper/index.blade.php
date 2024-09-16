@extends('layout.master')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center p-3 py-0">
            <h4 class="fw-bold py-3 mb-2">
                <a href="{{ url('dashboard') }}" class="text-muted fw-light">Dashboard </a>
                <span class="color">/ Shipment</span>
            </h4>
            <button class="btn btn-secondary create-new btn-primary" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" tabindex="0"
                aria-controls="DataTables_Table_0">
                <span><i class="mdi mdi-filter-outline me-sm-1"></i>
                    <span class="d-none d-sm-inline-block">Filters</span></span>
            </button>
        </div>

        <div class="card-body">
            <div class="col-20">
                <div class="card mb-4">
                    <div class="collapse" id="collapseExample">
                        <div class="d-grid p-3 border">
                            <form method="GET" id="myForm" action="{{ url('/shipper') }}" enctype="multipart/form-data"
                                class="row g-3">
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
                                            <label for="basic-icon-default-fullname">Name</label>
                                        </div>
                                    </div>
                                    <span class="text-danger validation-name" style="display: none;">
                                        <i class="mdi mdi-alert"></i> Name is invalid
                                    </span>
                                </div>

                                <div class="d-flex justify-content-end p-1 py-1">
                                    <button class="btn btn-secondary create-new btn-primary" tabindex="0"
                                        type="submit"><span><i class="mdi mdi-magnify"></i>
                                            <span class="d-none d-sm-inline-block">Search</span></span></button>
                                    <a href="{{ url('/shipper') }}" class="btn btn-danger" tabindex="0"><span><i
                                                class="mdi mdi-close"></i>
                                            <span class="d-none d-sm-inline-block">Clear</span></span></a>
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
                <div class="head-label text-center"></div>
                <div class="dt-action-buttons pt-3 pt-md-0">
                    <div class="dt-buttons btn-group flex-wrap">
                        <a href="{{ route('shipper.add') }}" class="btn btn-secondary create-new btn-primary" tabindex="0"
                            aria-controls="DataTables_Table_0">
                            <span><i class="mdi mdi-plus me-sm-1"></i>
                                <span class="d-none d-sm-inline-block">Add New</span></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card-datatable table-responsive pt-0 p-3">
                        <table class="datatables-basic table table-bordered">
                            <thead>
                                <tr>
                                    <th><h6>ID</h6></th>
                                    <th><h6>Shipper Name</h6></th>
                                    <th><h6>Invoice #</h6></th>
                                    <th><h6>Marks and Numbers</h6></th>
                                    <th><h6>B/L #</h6></th>
                                    <th><h6>Vessel Voy</h6></th>
                                    <th><h6>Deliver City</h6></th>
                                    <th><h6>Imcont #</h6></th>
                                    <th><h6>Delivery Address</h6></th>
                                    <th><h6>EXPC #</h6></th>
                                    <th><h6>Bags</h6></th>
                                    <th><h6>Landing Date</h6></th>
                                    <th><h6>EWAY Bill</h6></th>
                                    <th><h6>RTGS Amount</h6></th>
                                    <th><h6>Vehicle / Driver</h6></th>
                                    <th><h6>Delivery Status</h6></th>
                                    <th><h6>Actions</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shipments as $shipment)
                                    <tr>
                                        <td>{{ $shipment->id }}</td>
                                        <td>{{ $shipment->client->name }}</td>
                                        <td>{{ $shipment->invoice_no }}</td>
                                        <td>{{ $shipment->marks_and_numbers }}</td>
                                        <td>{{ $shipment->bl_no }}</td>
                                        <td>{{ $shipment->vessel_voy }}</td>
                                        <td>{{ $shipment->delivery_city }}</td>
                                        <td>{{ $shipment->imcont_no }}</td>
                                        <td>{{ $shipment->delivery_address }}</td>
                                        <td>{{ $shipment->expc_no }}</td>
                                        <td>{{ $shipment->bags }}</td>
                                        <td>{{ $shipment->landing_date }}</td>
                                        <td>{{ $shipment->eway_bill }}</td>
                                        <td>{{ $shipment->rtgs_amount }}</td>
                                        <td>{{ $shipment->vehicle_and_driver }}</td>
                                        <td>
                                            @if($shipment->delivery_status == 1)
                                                <span style="color: green;">Delivered</span>
                                            @elseif($shipment->delivery_status == 2)
                                                <span style="color: yellow;">Pending</span>
                                            @elseif($shipment->delivery_status == 0)
                                                <span style="color: red;">Rejected</span>
                                            @else
                                                <span style="color: gray;">Unknown</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a class="btn btn-primary me-2 p-2-5" href="{{ route('shipper.edit', $shipment->id) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                        
                                                <form action="{{ route('shipper.delete', $shipment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this shipment?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger me-2 p-2-5">
                                                        <i class="fa fa-trash"></i>
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
            </div>
        </div>
    </div>

    <script>
        function changePerPage(select) {
            const perPage = select.value;
            window.location.href = `{{ url('shipper') }}?perPage=${perPage}`;
        }
    </script>
@endsection
