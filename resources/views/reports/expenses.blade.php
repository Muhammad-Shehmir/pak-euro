@extends('layout.master')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center p-3 py-0">
            <h4 class="fw-bold py-3 mb-2"><a href="{{ url('dashboard') }}" class="text-muted fw-light">Dashboard </a><a
                    href="{{ url('dashboard') }}" class="text-muted fw-light"> / Reports</a><span class="color"> / Expenses
            </h4></span>
            <div class="">
                <a href="{{ url('export-expenses') . '?' . http_build_query(['date_from' => request()->date_from, 'date_to' => request()->date_to, 'chart_of_account' => request()->chart_of_account, 'expense_categories' => request()->expense_categories]) }}"
                    class="btn btn-secondary create-new btn-primary" type="button"><span><i
                            class="mdi mdi-microsoft-excel me-sm-1"></i>
                        <span class="d-none d-sm-inline-block">Excel</span></span></a>
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
                        <form method="GET" id="myForm" action="{{ url('/expense-reports') }}"
                            enctype="multipart/form-data" id="formValidationExamples" class="row g-3">
                            @csrf
                            <div class="col-md-2">
                                <div class="input-group input-group-merge mb-2">
                                    <div class="form-floating form-floating-outline">
                                        <select name="chart_of_account" type="text"
                                            class="select2 form-select form-select-lg" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($chartofaccount as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="basic-icon-default-fullname">Chart of Account</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge mb-2">
                                    <div class="form-floating form-floating-outline">
                                        <select name="expenseCategory" type="text"
                                            class="select2 form-select form-select-lg" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($expensecategories as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="basic-icon-default-phone">Expense Category</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge">
                                    <span id="dateTime" class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" class="form-control" id="date_from" name="date_from"
                                            placeholder="Date From" value="{{ request('date_from') }}" />
                                        <label for="date_from">Date From</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge">
                                    <span id="dateTime" class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" class="form-control" id="date_to" name="date_to"
                                            placeholder="Date To" value="{{ request('date_to') }}" />
                                        <label for="date_to">Date To</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end p-3 py-0">
                                <button class="btn btn-secondary create-new btn-primary" tabindex="0"
                                    type="submit"><span><i class="mdi mdi-magnify"></i>
                                        <span class="d-none d-sm-inline-block">Search</span></span></button>
                                <a href="{{ url('/expense-reports') }}" class="btn btn-danger" tabindex="0"><span><i
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

                            <th>
                                <h6>ID</h6>
                            </th>
                            <th>
                                <h6>Chart Of Account</h6>
                            </th>
                            <th>
                                <h6>Expense Category</h6>
                            </th>
                            <th>
                                <h6>Amount</h6>
                            </th>
                            <th>
                                <h6>Created Date</h6>
                            </th>
                            {{-- <th>
                                <h6>CNIC</h6>
                            </th> --}}
                            {{-- <th>
                                <h6>Type</h6>
                            </th>
                            <th>
                                <h6>Actions</h6>
                            </th> --}}
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $index => $expense)
                            <tr>
                                <td>{{ $expense->id }}</td>
                                <td>{{ $expense->chart_of_account->name ?? '-' }}</td>
                                <td>{{ $expense->expense_categories->name ?? '-' }}</td>
                                <td>{{ $expense->amount ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($expense->created_at)->format('d / M / Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            <div class="card-footer d-flex justify-content-end align-items-end">
                <div class="mb-3 me-3">
                    <label for="perPage" class="form-label">Show Items:</label>
                    <select id="perPage" name="perPage" class="form-select" onchange="changePerPage(this)">
                        <option value="5" @if ($perPage == 5) selected @endif>5</option>
                        <option value="10" @if ($perPage == 10) selected @endif>10</option>
                        <option value="15" @if ($perPage == 15) selected @endif>15</option>
                        <option value="25" @if ($perPage == 25) selected @endif>25</option>
                    </select>
                </div>

                {{ $expenses->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </div>
    <script>
        function changePerPage(select) {
            const perPage = select.value;
            window.location.href = `{{ url('patients') }}?perPage=${perPage}`;
        }
    </script>
@endsection
