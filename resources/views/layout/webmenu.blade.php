<!-- Menu -->
<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        <ul class="menu-inner">
            <!-- Dashboards -->
            <li class="menu-item {{ Request::path() == 'dashboard' ? 'active' : '' }}">
                <a href="{{ url('/dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                    <div data-i18n="Dashboard">Dashboard</div>
                </a>
            </li>
            @can('customer-view')
                <li class="menu-item  {{ Request::path() == 'client' ? 'active' : '' }}">
                    <a href="{{ url('/client') }}" class="menu-link">
                        <i class="menu-icon tf-icons mdi mdi-account-injury-outline"></i>
                        <div data-i18n="client">Client / Vendor</div>
                    </a>
                </li>
            @endcan
            @can('booking-view')
                {{-- <li
                    class="menu-item {{ Request::path() == 'booking' || Request::path() == 'booking-list' ? 'active' : '' }}">
                    <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons mdi mdi-clock-plus-outline"></i>
                        <div data-i18n="Rooms Booking">Rooms Booking</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::path() == 'booking' ? 'active' : '' }}">
                            <a href="{{ url('/booking') }}" class="menu-link">
                                <i class="menu-icon tf-icons mdi mdi-clock-plus-outline"></i>
                                <div data-i18n="Rooms Booking">Calendar</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Request::path() == 'booking-list' ? 'active' : '' }}">
                            <a href="{{ url('/booking-list') }}" class="menu-link">
                                <i class="menu-icon tf-icons mdi mdi-clock-plus-outline"></i>
                                <div data-i18n="Rooms Booking">List</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Request::path() == 'room-availability' ? 'active' : '' }}">
                            <a href="{{ url('/room-availability') }}" class="menu-link">
                                <i class="menu-icon tf-icons mdi mdi-clock-plus-outline"></i>
                                <div data-i18n="Rooms Booking">Room Availability</div>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li
                    class="menu-item {{ Request::path() == 'shipper' || Request::path() == 'shipper-list' ? 'active' : '' }}">
                    <a href="{{url('/shipper')}}" class="menu-link">
                        <i class="menu-icon tf-icons mdi mdi-clock-plus-outline"></i>
                        <div data-i18n="shipment">Shipment</div>
                    </a>
                </li> --}}
            @endcan

            {{-- @can('treatment_plan-view')
                <li class="menu-item  {{ Request::path() == 'treatment-plans' ? 'active' : '' }}">
                    <a href="{{ url('/treatment-plans') }}" class="menu-link">
                        <i class="menu-icon tf-icons mdi mdi-receipt-text-clock-outline"></i>
                        <div data-i18n="Treatment Plans">Treatment Plans</div>
                    </a>
                </li>
            @endcan --}}
            {{-- @can('quote-view')
                <li class="menu-item {{ Request::path() == 'quote' ? 'active' : '' }}">
                    <a href="{{ url('/quote') }}" class="menu-link">
                        <i class="menu-icon tf-icons mdi  mdi-file-document-outline"></i>
                        <div data-i18n="Quote">Quote</div>
                    </a>
                </li>
            @endcan --}}
            {{-- @can('invoice-view')
                <li class="menu-item {{ Request::path() == 'invoice' ? 'active' : '' }}">
                    <a href="{{ url('/invoice') }}" class="menu-link">
                        <i class="menu-icon tf-icons mdi  mdi-file-document-outline"></i>
                        <div data-i18n="Invoice">Invoice</div>
                    </a>
                </li>
            @endcan --}}
            <li
                class="menu-item {{ Request::path() === 'ledger-report' || Request::path() == 'security-detail-reports' ? 'active' : '' }}">
                <a href="{{ url('/ledger-report') }}" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons mdi mdi-file-document-check-outline"></i>
                    <div data-i18n="Reports">Reports</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item {{ Request::path() == 'ledger-reports' ? 'active' : '' }}">
                        <a href="{{ url('/ledger-reports') }}" class="menu-link">
                            <i class="menu-icon tf-icons mdi mdi-account-cash-outline"></i>
                            <div data-i18n="ledgers">Ledgers</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::path() == 'vendor-ledger-reports' ? 'active' : '' }}">
                        <a href="{{ url('/vendor-ledger-reports') }}" class="menu-link">
                            <i class="menu-icon tf-icons mdi mdi-account-cash-outline"></i>
                            <div data-i18n="Vendor Ledgers">Vendor Ledgers</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::path() == 'security-detail-reports' ? 'active' : '' }}">
                        <a href="{{ url('/security-detail-reports') }}" class="menu-link">
                            <i class="menu-icon tf-icons mdi mdi-clock-plus-outline"></i>
                            <div data-i18n="Security Detail">Security Detail</div>
                        </a>
                    </li>
                </ul>
            </li>

            @if (auth()->user()->can('product-view') ||
                    auth()->user()->can('customer_source-view') ||
                    auth()->user()->can('product_category-view'))
                <li
                    class="menu-item {{ Request::path() === 'procedure' || Request::path() == 'tax' || Request::path() == 'chart-of-account' || Request::path() == 'account-type' || Request::path() == 'lab-of-tracking' || Request::path() == 'expense-categories' || Request::path() == 'dental-diseases' || Request::path() == 'expense' || Request::path() == 'refferal-hospital' ? 'active' : '' }}">
                    <a href="{{ url('/master') }}" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons mdi mdi-cogs"></i>
                        <div data-i18n="Master Pages">Master Pages</div>
                    </a>

                    <ul class="menu-sub">
                        @can('product-view')
                            <li class="menu-item {{ Request::path() == 'products' ? 'active' : '' }}">
                                <a href="{{ url('/charges') }}" class="menu-link">
                                    <i class="menu-icon tf-icons mdi mdi-cog-sync"></i>
                                    <div data-i18n="Products">Charges</div>
                                </a>
                            </li>
                        @endcan
                        {{-- @can('product_category-view')
                            <li class="menu-item {{ Request::path() == 'product-categories' ? 'active' : '' }}">
                                <a href="{{ url('/product-categories') }}" class="menu-link">
                                    <i class="menu-icon tf-icons mdi mdi-cog-sync"></i>
                                    <div data-i18n="Product Categories">Product Categories</div>
                                </a>
                            </li>
                        @endcan
                        @can('customer_source-view')
                            <li class="menu-item {{ Request::path() == 'customer-source' ? 'active' : '' }}">
                                <a href="{{ url('/customer-source') }}" class="menu-link">
                                    <i class="menu-icon tf-icons mdi mdi-account-badge-outline"></i>
                                    <div data-i18n="Customer Source">Customer Source</div>
                                </a>
                            </li>
                        @endcan --}}
                    </ul>
                </li>
            @else
            @endif

            @if (auth()->user()->can('user-view') || auth()->user()->can('roles-view'))
                <li class="menu-item {{ Request::path() == 'user' || Request::path() == 'role' ? 'active' : '' }}">
                    <a href="{{ url('') }}" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons mdi mdi-security"></i>
                        <div data-i18n="Administration">Administration</div>
                    </a>
                    <ul class="menu-sub">
                        @can('user-view')
                            <li class="menu-item  {{ Request::path() == 'user' ? 'active' : '' }}">
                                <a href="{{ url('/user') }}" class="menu-link">
                                    <i class="menu-icon tf-icons mdi mdi-account-key-outline"></i>
                                    <div data-i18n="User">Users</div>
                                </a>
                            </li>
                        @endcan
                        @can('roles-view')
                            <li class="menu-item {{ Request::path() == 'role' ? 'active' : '' }}">
                                <a href="{{ url('/role') }}" class="menu-link">
                                    <i class="menu-icon tf-icons mdi mdi-account-star-outline"></i>
                                    <div data-i18n="Roles">Roles</div>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @else
            @endif
        </ul>
    </div>
</aside>
<!-- / Menu -->
