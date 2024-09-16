@extends('layout.master')

<link rel="stylesheet" href="{{ url('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="card-title pt-2 pb-3">Welcome to Dashboard <strong> {{ auth()->user()->name }} !</strong></h4>
        <div class="row gy-4">
            <!-- Ratings -->
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <a href="{{ url('#') }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div class="card-info">
                                        <h5 class="mb-2 text-nowrap">Clients</h5>
                                        <div class="badge bg-label-primary rounded-pill lh-xs">Total Clients</div>
                                    </div>
                                    <div class="d-flex ">
                                        <h3 class="mb-0 mt-1 me-2">{{ $clientsCount }}</h3>
                                        {{-- <small class="text-success">+15.6%</small> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 text-center d-flex align-items-center">
                                {{-- <div class="card-body p-0 h-full">
                                <img src="{{ url('/appointment-icon.png') }}" width="80px" height="80px" alt="Ratings"
                                class="img-fluid" />
                            </div> --}}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!--/ Ratings -->

            <!-- Sessions -->
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <a href="{{ url('#') }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div class="card-info">
                                        <h5 class="mb-2 text-nowrap">Shipments</h5>
                                        <div class="badge bg-label-success rounded-pill lh-xs">Total Shipments</div>
                                    </div>
                                    <div class="d-flex ">
                                        <h3 class="mb-0 mt-1 me-2">{{ $shipmentCount }}</h3>
                                        {{-- <small class="text-danger">-25.5%</small> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 text-center d-flex align-items-center">
                                {{-- <div class="card-body p-0 h-full">
                                <img src="{{ url('patient-dentist.png') }}" width="80px" height="80px" alt="Ratings"
                                    class="img-fluid" />
                                </div> --}}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!--/ Sessions -->

            <!-- Customers -->
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div class="card-info">
                                    <h5 class="mb-2 text-nowrap">Invoices</h5>
                                    <div class="badge bg-label-warning rounded-pill lh-xs">Total Invoices</div>
                                </div>
                                <div class="d-flex  d-flex ">
                                    <h3 class="mb-0 mt-1 me-2">{{ $invoicesCount }}</h3>
                                    {{-- <small class="text-success">+9.2%</small> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-center d-flex align-items-center">
                            {{-- <div class="card-body p-0 h-full">
                                <img src="{{ url('/visited.png') }}" width="80px" height="80px" alt="Ratings"
                                    class="img-fluid" />
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Customers -->

            <!-- Total Orders -->
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div class="card-info">
                                    <h5 class="mb-2 text-nowrap">Receipt / Payment</h5>
                                    <div class="badge bg-label-secondary rounded-pill lh-xs">Total Receipts / Payments</div>
                                </div>
                                <div class="d-flex ">
                                    <h4 class="mb-0 mt-2 me-2 text-nowrap">{{ $receiptsCount }}</h4>
                                    {{-- <small class="text-success">+10.8%</small> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-center d-flex align-items-center">
                            {{-- <div class="card-body p-0 h-full">
                                <img src="{{ url('/payment.png') }}" width="80px" height="80px" alt="Ratings"
                                    class="img-fluid" />
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-sm-12 app-calendar-content">
                <div class="card">
                    {{-- <div class="card-header flex-column flex-md-row">
                        <div class="head-label">
                            <h5 class="mb-0 text-nowrap">Financial Summary</h5>
                        </div>
                    </div> --}}
                    {{-- <div class="card-datatable table-responsive p-3 pt-0">
                        <table class="datatables-basic table table-bordered">
                            <thead>
                                <tr>

                                    <th>
                                        <h6>S No.</h6>
                                    </th>
                                    <th>
                                        <h6>Name</h6>
                                    </th>
                                    <th>
                                        <h6>Room No.</h6>
                                    </th>
                                    <th>
                                        <h6>Time Start</h6>
                                    </th>
                                    <th>
                                        <h6>Time End</h6>
                                    </th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recent_bookings as $index => $booking)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $booking->customer->name }}</td>
                                        <td>{{ $booking->product->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($booking->booking_start)->format('h:i:s A') }}
                                        <td>{{ \Carbon\Carbon::parse($booking->booking_end)->format('h:i:s A') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div> --}}

                    {{-- <div class="card-footer d-flex justify-content-end align-items-end">
                        <div class="mb-3 me-3">
                            <label for="perPage" class="form-label">Show Items:</label>
                            <select id="perPage" name="perPage" class="form-select" onchange="changePerPage(this)">
                                <option value="5" @if ($perPage == 5) selected @endif>5</option>
                                <option value="10" @if ($perPage == 10) selected @endif>10</option>
                                <option value="15" @if ($perPage == 15) selected @endif>15</option>
                                <option value="25" @if ($perPage == 25) selected @endif>25</option>
                            </select>
                        </div>

                        {{ $patients->links('pagination::bootstrap-4') }}
                    </div> --}}

                </div>
            </div>

            {{-- <div class="col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1">Weekly Finance</h5>
                        </div>
                        <p class="mb-0 text-muted">Total $ {{ number_format($total_amount_received, 2) }}</p>
                    </div>
                    <div class="card-body">
                        <div id="weeklyOverviewChart"></div>
                        <div class="mt-1">
                            <div class="d-grid mt-3">
                                <a href="{{ url('invoice') }}" class="btn btn-primary">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <!-- Total Transactions & Report Chart -->
            <div class="col-12 col-xl-8">
                <div class="card">
                    <div class="row">
                        <div class="col-md-7 col-12 order-2 order-md-0">
                            <div class="card-header">
                                <h5 class="mb-0">Total Transactions</h5>
                            </div>
                            <div class="card-body">
                                <div id="totalTransactionChart"></div>
                            </div>
                        </div>
                        <div class="col-md-5 col-12 border-start">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-1">Report</h5>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="totalTransaction"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalTransaction">
                                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted mb-0">Last month transactions $234.40k</p>
                            </div>
                            <div class="card-body pt-3">
                                <div class="row">
                                    <div class="col-6 border-end">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="avatar">
                                                <div class="avatar-initial bg-label-success rounded">
                                                    <div class="mdi mdi-trending-up mdi-24px"></div>
                                                </div>
                                            </div>
                                            <p class="text-muted my-2">This Week</p>
                                            <h6 class="mb-0 fw-semibold">+82.45%</h6>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="avatar">
                                                <div class="avatar-initial bg-label-primary rounded">
                                                    <div class="mdi mdi-trending-down mdi-24px"></div>
                                                </div>
                                            </div>
                                            <p class="text-muted my-2">This Week</p>
                                            <h6 class="mb-0 fw-semibold">-24.86%</h6>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <div class="d-flex justify-content-around">
                                    <div>
                                        <p class="text-muted mb-1">Performance</p>
                                        <h6 class="mb-0 fw-semibold">+94.15%</h6>
                                    </div>
                                    <button class="btn btn-primary" type="button">view report</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Total Transactions & Report Chart -->

            <!-- Performance Chart -->
            <div class="col-12 col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-header pb-1">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1">Performance</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="performanceDropdown"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="performanceDropdown">
                                    <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div id="performanceChart"></div>
                    </div>
                </div>
            </div>
            <!--/ Performance Chart -->

            <!-- Project Statistics -->
            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Project Statistics</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="projectStatus" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical mdi-24px"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="projectStatus">
                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-3 justify-content-between pb-2">
                                <h6 class="mb-0 small">NAME</h6>
                                <h6 class="mb-0 small">BUDGET</h6>
                            </li>
                            <li class="d-flex mb-4">
                                <div class="avatar avatar-md flex-shrink-0 me-3">
                                    <div class="avatar-initial bg-lighter rounded">
                                        <div>
                                            <img src="../../assets/img/icons/misc/3d-illustration.png" alt="User"
                                                class="h-25" />
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">3D Illustration</h6>
                                        <small class="text-muted">Blender Illustration</small>
                                    </div>
                                    <div class="badge bg-label-primary rounded-pill">$6,500</div>
                                </div>
                            </li>
                            <li class="d-flex mb-4">
                                <div class="avatar avatar-md flex-shrink-0 me-3">
                                    <div class="avatar-initial bg-lighter rounded">
                                        <div>
                                            <img src="../../assets/img/icons/misc/finance-app-design.png" alt="User"
                                                class="h-25" />
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Finance App Design</h6>
                                        <small class="text-muted">Figma UI Kit</small>
                                    </div>
                                    <div class="badge bg-label-primary rounded-pill">$4,290</div>
                                </div>
                            </li>
                            <li class="d-flex mb-4">
                                <div class="avatar avatar-md flex-shrink-0 me-3">
                                    <div class="avatar-initial bg-lighter rounded">
                                        <div>
                                            <img src="../../assets/img/icons/misc/4-square.png" alt="User"
                                                class="h-25" />
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">4 Square</h6>
                                        <small class="text-muted">Android Application</small>
                                    </div>
                                    <div class="badge bg-label-primary rounded-pill">$44,500</div>
                                </div>
                            </li>
                            <li class="d-flex mb-4">
                                <div class="avatar avatar-md flex-shrink-0 me-3">
                                    <div class="avatar-initial bg-lighter rounded">
                                        <div>
                                            <img src="../../assets/img/icons/misc/delta-web-app.png" alt="User"
                                                class="h-25" />
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Delta Web App</h6>
                                        <small class="text-muted">React Dashboard</small>
                                    </div>
                                    <div class="badge bg-label-primary rounded-pill">$12,690</div>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="avatar avatar-md flex-shrink-0 me-3">
                                    <div class="avatar-initial bg-lighter rounded">
                                        <div>
                                            <img src="../../assets/img/icons/misc/ecommerce-website.png" alt="User"
                                                class="h-25" />
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">eCommerce Website</h6>
                                        <small class="text-muted">Vue + Laravel</small>
                                    </div>
                                    <div class="badge bg-label-primary rounded-pill">$10,850</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Project Statistics -->

            <!-- Multiple widgets -->
            <div class="col-md-6 col-xl-4">
                <div class="row g-4">
                    <!-- Total Revenue chart -->
                    <div class="col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-end mb-1 flex-wrap gap-2">
                                    <h4 class="mb-0 me-2">$42.5k</h4>
                                    <p class="mb-0 text-danger">-22%</p>
                                </div>
                                <span class="d-block mb-2 text-muted">Total Revenue</span>
                            </div>
                            <div class="card-body">
                                <div id="totalRevenue"></div>
                            </div>
                        </div>
                    </div>
                    <!--/ Total Revenue chart -->

                    <div class="col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-label-success rounded">
                                            <i class="mdi mdi-currency-usd mdi-24px"></i>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 text-success me-1">+38%</p>
                                        <i class="mdi mdi-chevron-up text-success"></i>
                                    </div>
                                </div>
                                <div class="card-info mt-4 pt-3">
                                    <h5 class="mb-2">$13.4k</h5>
                                    <p class="text-muted">Total Sales</p>
                                    <div class="badge bg-label-secondary rounded-pill mt-1">Last Sales</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-label-info rounded">
                                            <i class="mdi mdi-link mdi-24px"></i>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 text-success me-1">+62%</p>
                                        <i class="mdi mdi-chevron-up text-success"></i>
                                    </div>
                                </div>
                                <div class="card-info mt-4 pt-4">
                                    <h5 class="mb-2">142.8k</h5>
                                    <p class="text-muted">Total Impression</p>
                                    <div class="badge bg-label-secondary rounded-pill">Last One Year</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- overview Radial chart -->
                    <div class="col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-end mb-1 flex-wrap gap-2">
                                    <h4 class="mb-0 me-2">$67.1k</h4>
                                    <p class="mb-0 text-success">+49%</p>
                                </div>
                                <span class="d-block mb-2 text-muted">Overview</span>
                            </div>
                            <div class="card-body">
                                <div id="overviewChart" class="d-flex align-items-center"></div>
                            </div>
                        </div>
                    </div>
                    <!--/ overview Radial chart -->
                </div>
            </div>
            <!--/ Multiple widgets -->

            <!-- Sales Country Chart -->
            <div class="col-12 col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1">Sales Country</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="salesCountryDropdown"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesCountryDropdown">
                                    <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0 text-muted">Total $42,580 Sales</p>
                    </div>
                    <div class="card-body pb-1 px-0">
                        <div id="salesCountryChart"></div>
                    </div>
                </div>
            </div>
            <!--/ Sales Country Chart -->

            <!-- Top Referral Source  -->
            <div class="col-12 col-xl-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="card-title m-0">
                            <h5 class="mb-0">Top Referral Sources</h5>
                            <small class="text-muted">82% Activity Growth</small>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="earningReportsTabsId" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical mdi-24px"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsTabsId">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-3">
                        <ul class="nav nav-tabs nav-tabs-widget pb-3 gap-4 mx-1 d-flex flex-nowrap" role="tablist">
                            <li class="nav-item">
                                <div class="nav-link btn active d-flex flex-column align-items-center justify-content-center"
                                    role="tab" data-bs-toggle="tab" data-bs-target="#navs-orders-id"
                                    aria-controls="navs-orders-id" aria-selected="true">
                                    <button type="button" class="btn btn-icon rounded-pill btn-label-google-plus">
                                        <i class="mdi mdi-google mdi-20px"></i>
                                    </button>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="nav-link btn d-flex flex-column align-items-center justify-content-center"
                                    role="tab" data-bs-toggle="tab" data-bs-target="#navs-sales-id"
                                    aria-controls="navs-sales-id" aria-selected="false">
                                    <button type="button" class="btn btn-icon rounded-pill btn-label-facebook">
                                        <i class="mdi mdi-facebook mdi-20px"></i>
                                    </button>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="nav-link btn d-flex flex-column align-items-center justify-content-center"
                                    role="tab" data-bs-toggle="tab" data-bs-target="#navs-profit-id"
                                    aria-controls="navs-profit-id" aria-selected="false">
                                    <button type="button" class="btn btn-icon rounded-pill btn-label-instagram">
                                        <i class="mdi mdi-instagram mdi-20px"></i>
                                    </button>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="nav-link btn d-flex flex-column align-items-center justify-content-center"
                                    role="tab" data-bs-toggle="tab" data-bs-target="#navs-income-id"
                                    aria-controls="navs-income-id" aria-selected="false">
                                    <button type="button" class="btn btn-icon rounded-pill btn-label-twitter">
                                        <i class="mdi mdi-twitter mdi-20px"></i>
                                    </button>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="nav-link btn d-flex align-items-center justify-content-center disabled"
                                    role="tab" data-bs-toggle="tab" aria-selected="false">
                                    <button type="button" class="btn btn-icon rounded bg-label-secondary">
                                        <i class="mdi mdi-plus mdi-20px"></i>
                                    </button>
                                </div>
                            </li>
                        </ul>
                        <div class="tab-content p-0 ms-0 ms-sm-2">
                            <div class="tab-pane fade show active" id="navs-orders-id" role="tabpanel">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="fw-medium ps-0 text-heading">Parameter</th>
                                                <th class="pe-0 fw-medium text-heading">Status</th>
                                                <th class="pe-0 fw-medium text-heading">Conversion</th>
                                                <th class="pe-0 text-end text-heading">total revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-heading fw-semibold ps-0">Email Marketing Campaign</td>
                                                <td class="pe-0"><span
                                                        class="badge rounded-pill bg-label-primary">Active</span></td>
                                                <td class="pe-0 text-success">+24%</td>
                                                <td class="pe-0 text-end fw-semibold h6">$42,857</td>
                                            </tr>
                                            <tr>
                                                <td class="text-heading fw-semibold ps-0">Google Workspace</td>
                                                <td class="pe-0">
                                                    <span class="badge rounded-pill bg-label-warning">Completed</span>
                                                </td>
                                                <td class="text-danger pe-0">-12%</td>
                                                <td class="pe-0 text-end fw-semibold h6">$850</td>
                                            </tr>
                                            <tr>
                                                <td class="text-heading fw-semibold ps-0">Affiliation Program</td>
                                                <td class="pe-0"><span
                                                        class="badge rounded-pill bg-label-primary">Active</span></td>
                                                <td class="text-success pe-0">+24%</td>
                                                <td class="pe-0 text-end fw-semibold h6">$5,576</td>
                                            </tr>
                                            <tr>
                                                <td class="text-heading fw-semibold ps-0">Google Adsense</td>
                                                <td class="pe-0"><span class="badge rounded-pill bg-label-info">In
                                                        Draft</span></td>
                                                <td class="text-success pe-0">0%</td>
                                                <td class="pe-0 text-end fw-semibold h6">$0</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-sales-id" role="tabpanel">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="fw-medium ps-0 text-heading">parameter</th>
                                                <th class="pe-0 fw-medium text-heading">Status</th>
                                                <th class="pe-0 fw-medium text-heading">Conversion</th>
                                                <th class="pe-0 text-end text-heading">total revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-heading fw-semibold ps-0">Create Audiences in Ads Manager
                                                </td>
                                                <td class="pe-0"><span
                                                        class="badge rounded-pill bg-label-primary">Active</span></td>
                                                <td class="pe-0 text-danger">-8%</td>
                                                <td class="pe-0 text-end fw-semibold h6">$322</td>
                                            </tr>
                                            <tr>
                                                <td class="text-heading fw-semibold ps-0">Facebook page advertising</td>
                                                <td class="pe-0"><span
                                                        class="badge rounded-pill bg-label-primary">Active</span></td>
                                                <td class="text-success pe-0">+19%</td>
                                                <td class="pe-0 text-end fw-semibold h6">$5,634</td>
                                            </tr>
                                            <tr>
                                                <td class="text-heading fw-semibold ps-0">Messenger advertising</td>
                                                <td class="pe-0"><span
                                                        class="badge rounded-pill bg-label-danger">Expired</span></td>
                                                <td class="text-danger pe-0">-23%</td>
                                                <td class="pe-0 text-end fw-semibold h6">$751</td>
                                            </tr>
                                            <tr>
                                                <td class="text-heading fw-semibold ps-0">Video campaign</td>
                                                <td class="pe-0">
                                                    <span class="badge rounded-pill bg-label-warning">Completed</span>
                                                </td>
                                                <td class="text-success pe-0">+21%</td>
                                                <td class="pe-0 text-end fw-semibold h6">$3,585</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-profit-id" role="tabpanel">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="fw-medium ps-0 text-heading">parameter</th>
                                                <th class="pe-0 fw-medium text-heading">Status</th>
                                                <th class="pe-0 fw-medium text-heading">Conversion</th>
                                                <th class="pe-0 text-end text-heading">total revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-heading fw-semibold ps-0">Create shopping advertising</td>
                                                <td class="pe-0"><span class="badge rounded-pill bg-label-info">In
                                                        Draft</span></td>
                                                <td class="pe-0 text-danger">-15%</td>
                                                <td class="pe-0 text-end fw-semibold h6">$599</td>
                                            </tr>
                                            <tr>
                                                <td class="text-heading fw-semibold ps-0">IGTV advertising</td>
                                                <td class="pe-0">
                                                    <span class="badge rounded-pill bg-label-warning">Completed</span>
                                                </td>
                                                <td class="text-success pe-0">+37%</td>
                                                <td class="pe-0 text-end fw-semibold h6">$1,467</td>
                                            </tr>
                                            <tr>
                                                <td class="text-heading fw-semibold ps-0">Collection advertising</td>
                                                <td class="pe-0"><span class="badge rounded-pill bg-label-info">In
                                                        Draft</span></td>
                                                <td class="text-danger pe-0">0%</td>
                                                <td class="pe-0 text-end fw-semibold h6">$0</td>
                                            </tr>
                                            <tr>
                                                <td class="text-heading fw-semibold ps-0">Stories advertising</td>
                                                <td class="pe-0"><span
                                                        class="badge rounded-pill bg-label-primary">Active</span></td>
                                                <td class="text-success pe-0">+29%</td>
                                                <td class="pe-0 text-end fw-semibold h6">$4,546</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-income-id" role="tabpanel">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="fw-medium ps-0 text-heading">Parameter</th>
                                                <th class="pe-0 fw-medium text-heading">Status</th>
                                                <th class="pe-0 fw-medium text-heading">Conversion</th>
                                                <th class="pe-0 text-end text-heading">total revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-heading fw-semibold ps-0">Interests advertising</td>
                                                <td class="pe-0"><span
                                                        class="badge rounded-pill bg-label-danger">Expired</span></td>
                                                <td class="pe-0 text-success">+2%</td>
                                                <td class="pe-0 text-end fw-semibold h6">$404</td>
                                            </tr>
                                            <tr>
                                                <td class="text-heading fw-semibold ps-0">Community advertising</td>
                                                <td class="pe-0"><span
                                                        class="badge rounded-pill bg-label-primary">Active</span></td>
                                                <td class="text-success pe-0">+25%</td>
                                                <td class="pe-0 text-end fw-semibold h6">$399</td>
                                            </tr>
                                            <tr>
                                                <td class="text-heading fw-semibold ps-0">Device advertising</td>
                                                <td class="pe-0">
                                                    <span class="badge rounded-pill bg-label-warning">Completed</span>
                                                </td>
                                                <td class="text-success pe-0">+21%</td>
                                                <td class="pe-0 text-end fw-semibold h6">$177</td>
                                            </tr>
                                            <tr>
                                                <td class="text-heading fw-semibold ps-0">Campaigning</td>
                                                <td class="pe-0"><span
                                                        class="badge rounded-pill bg-label-primary">Active</span></td>
                                                <td class="text-danger pe-0">-5%</td>
                                                <td class="pe-0 text-end fw-semibold h6">$1,139</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Top Referral Source  -->

            <!-- Weekly Sales Chart-->
            <div class="col-12 col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1">Weekly Sales</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="weeklySalesDropdown"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="weeklySalesDropdown">
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted mb-0">Total 85.4k Sales</p>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-6 d-flex align-items-center">
                                <div class="avatar">
                                    <div class="avatar-initial bg-label-primary rounded">
                                        <i class="mdi mdi-trending-up mdi-24px"></i>
                                    </div>
                                </div>
                                <div class="ms-3 d-flex flex-column">
                                    <small class="text-muted mb-1">Net Income</small>
                                    <h6 class="mb-0 fw-semibold">$438.5K</h6>
                                </div>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <div class="avatar">
                                    <div class="avatar-initial bg-label-warning rounded">
                                        <i class="mdi mdi-currency-usd mdi-24px"></i>
                                    </div>
                                </div>
                                <div class="ms-3 d-flex flex-column">
                                    <small class="text-muted mb-1">Expense</small>
                                    <h6 class="mb-0 fw-semibold">$22.4K</h6>
                                </div>
                            </div>
                        </div>
                        <div id="weeklySalesChart"></div>
                    </div>
                </div>
            </div>
            <!--/ Weekly Sales Chart-->

            <!-- visits By Day Chart-->
            <div class="col-12 col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-header pb-1">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1">Visits by Day</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="visitsByDayDropdown"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="visitsByDayDropdown">
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0 text-muted">Total 248.5k Visits</p>
                    </div>
                    <div class="card-body">
                        <div id="visitsByDayChart"></div>
                        <div class="d-flex justify-content-between mt-3">
                            <div>
                                <h6 class="mb-1 fw-semibold">Most Visited Day</h6>
                                <p class="mb-0 text-muted">Total 62.4k Visits on Thursday</p>
                            </div>
                            <div class="avatar">
                                <div class="avatar-initial bg-label-warning rounded">
                                    <i class="mdi mdi-chevron-right mdi-24px scaleX-n1-rtl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ visits By Day Chart-->

            <!-- Activity Timeline -->
            <div class="col-12 col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1">Activity Timeline</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="timelineDropdown" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="timelineDropdown">
                                    <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-4 pb-1">
                        <ul class="timeline card-timeline mb-0">
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-primary"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-1">
                                        <h6 class="mb-2 fw-semibold">Create youtube video for next product 😎</h6>
                                        <small class="text-muted">Tomorrow</small>
                                    </div>
                                    <p class="text-muted mb-2">Product introduction and details video</p>
                                    <div class="d-flex">
                                        <a href="https://www.youtube.com/@pixinvent1515" target="_blank"
                                            class="text-truncate">
                                            <span class="badge badge-center rounded-pill bg-danger w-px-20 h-px-20 me-2">
                                                <i class="mdi mdi-play text-white"></i>
                                            </span>
                                            <span
                                                class="fw-semibold text-muted">https://www.youtube.com/@pixinvent1515</span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-info"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-1">
                                        <h6 class="mb-2 fw-semibold">Received payment from usa client 😍</h6>
                                        <small class="text-muted">January, 18</small>
                                    </div>
                                    <p class="text-muted mb-2">Received payment $1,490 for banking ios app</p>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent border-0">
                                <span class="timeline-point timeline-point-warning"></span>
                                <div class="timeline-event pb-1">
                                    <div class="timeline-header mb-1">
                                        <h6 class="mb-2 fw-semibold">Meeting with joseph morgan for next project</h6>
                                        <small class="text-muted">April, 23</small>
                                    </div>
                                    <p class="text-muted mb-2">Meeting Video call on zoom at 9pm</p>
                                    <div class="d-flex">
                                        <a href="javascript:void(0)" class="me-3">
                                            <img src="../../assets/img/icons/misc/pdf.png" alt="PDF image" width="20"
                                                class="me-2" />
                                            <span class="fw-semibold text-muted">presentation.pdf</span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Activity Timeline --> --}}
        </div>
    </div>
    <!--/ Content -->
@endsection

<script src="{{ url('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        let borderColor = '#25bdad';

        const weeklyOverviewChartEl = document.querySelector('#weeklyOverviewChart');
        const salesData = @json($weekly_transactions);
        const salesAmount = @json($weekly_amount_transactions);
        const minValue = @json($minValue);
        const maxValue = @json($maxValue);

        const weeklyOverviewChartConfig = {
            chart: {
                type: 'line',
                height: 178,
                offsetY: -9,
                offsetX: -16,
                parentHeightOffset: 0,
                toolbar: {
                    show: false
                }
            },
            series: [{
                name: 'Paid',
                type: 'column',
                data: salesData
            }, {
                name: 'Amount',
                type: 'line',
                data: salesAmount
            }],
            plotOptions: {
                bar: {
                    borderRadius: 9,
                    columnWidth: '50%',
                    endingShape: 'rounded',
                    startingShape: 'rounded',
                    colors: {
                        ranges: [{
                            to: 50,
                            from: 40,
                            color: '#25bdad'
                        }]
                    }
                }
            },
            markers: {
                size: 3.5,
                strokeWidth: 2,
                fillOpacity: 1,
                strokeOpacity: 1,
                colors: ['#fff'],
                strokeColors: '#25bdad'
            },
            stroke: {
                width: [0, 2],
                colors: ['#25bdad']
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            colors: ['#bbbcc4'],
            grid: {
                strokeDashArray: 10,
                borderColor,
                padding: {
                    bottom: -10
                }
            },
            xaxis: {
                categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                tickPlacement: 'on',
                labels: {
                    show: false
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                min: 0,
                max: maxValue,
                show: true,
                tickAmount: 3,
                labels: {
                    formatter: function(val) {
                        return '$ ' + parseInt(val);
                    },
                    style: {
                        fontSize: '0.75rem',
                        fontFamily: 'Inter',
                        colors: '#bbbcc4'
                    }
                }
            },
            states: {
                hover: {
                    filter: {
                        type: 'none'
                    }
                },
                active: {
                    filter: {
                        type: 'none'
                    }
                }
            }
        };

        if (typeof weeklyOverviewChartEl !== 'undefined' && weeklyOverviewChartEl !== null) {
            const weeklyOverviewChart = new ApexCharts(weeklyOverviewChartEl, weeklyOverviewChartConfig);
            weeklyOverviewChart.render();
        }
    });
</script> --}}


