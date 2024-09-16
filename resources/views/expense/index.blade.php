@extends('layout.master')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center p-3 py-0">
            <h4 class="fw-bold py-3 mb-2"><a href="{{ url('dashboard') }}" class="text-muted fw-light">Dashboard </a><span
                    class="color">/ Expense
            </h4></span>
            <button class="btn btn-secondary create-new btn-primary" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" tabindex="0"
                aria-controls="DataTables_Table_0" type="button"><span><i class="mdi mdi-filter-outline me-sm-1"></i>
                    <span class="d-none d-sm-inline-block">Filters</span></span></button>
        </div>


        <div class="card-body">


            <div class="col-16">

                <div class="card mb-4">

                    <div class="collapse" id="collapseExample">
                        <div class="d-grid p-3 border">
                            <form method="Get" id="myForm" action="{{ url('/expense') }}" enctype="multipart/form-data"
                                id="formValidationExamples" class="row g-3">
                                @csrf
                                <div class="col-md-3">
                                    <div class="input-group input-group-merge mb-2">
                                        <div class="form-floating form-floating-outline">
                                            <select name="chart_of_account" type="text" class="select2 form-select form-select-lg" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($chartofaccount as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                            <label for="basic-icon-default-fullname">Chart of Account</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group input-group-merge mb-2">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="mdi mdi-calendar"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input name="Date" type="date" id="basic-icon-default-phone"
                                            value="{{ request('date') }}"  class="form-control " placeholder="YYYY-MM-DD"
                                                aria-label="YYYY-MM-DD" aria-describedby="basic-icon-default-phone2" />
                                            <label for="basic-icon-default-phone">Date</label>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-3">
                                    <div class="input-group input-group-merge mb-2">

                                        <div class="form-floating form-floating-outline">
                                            <select required name="account_type" type="text"
                                                class="select2 form-select form-select-lg" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($account_types as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="account_type">Account Type</label>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-3">
                                    <div class="input-group input-group-merge mb-2">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="mdi mdi-numeric"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input name="amount" type="text" id="basic-icon-default-phone"
                                                placeholder="Enter Amount" class="form-control"
                                                value="{{ request('amount') }}"
                                                aria-label="Enter Amount Number"
                                                aria-describedby="basic-icon-default-phone2" />
                                            <label for="basic-icon-default-phone">Amount</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-merge mb-2">
                                        <div class="form-floating form-floating-outline">
                                            <select name="expense_categories" type="text" class="select2 form-select form-select-lg" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($expensecategories as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                            <label for="basic-icon-default-phone">Expense Category</label>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-5"> --}}

                                <div class="d-flex justify-content-end  p-1 py-1">
                                    <button class="btn btn-secondary create-new btn-primary" tabindex="0"
                                        type="submit"><span><i class="mdi mdi-magnify"></i>
                                            <span class="d-none d-sm-inline-block">Search</span></span></button>
                                    <a href="{{ url('/expense') }}" class="btn btn-danger" tabindex="0"><span><i
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
        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-header flex-column flex-md-row">
                <div class="head-label text-center">
                </div>
                <div class="dt-action-buttons pt-3 pt-md-0">
                    <div class="dt-buttons btn-group flex-wrap">
                        <a href="{{ url('/expense/add') }}" class="btn btn-secondary create-new btn-primary" tabindex="0"
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
                                <h6>Chart Of Account</h6>
                            </th>
                            {{-- <th>
                                <h6>Mobile No.</h6>
                            </th> --}}
                            <th>
                                <h6>Description</h6>
                            </th>
                            <th>
                                <h6>Amount</h6>
                            </th>
                            {{-- <th>
                                <h6>Account Type</h6>
                            </th> --}}
                            <th>
                                <h6>Expense Category</h6>
                            </th>
                            <th>
                                <h6>Actions</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expense as $exp)
                            <tr>
                                <td>{{ $exp->id }}</td>
                                <td>{{ $exp->chart_of_account->name ?? '' }}</td>
                                <td>{{ $exp->description }}</td>
                                <td>{{ $exp->amount }}</td>
                                <td>{{ $exp->expense_categories->name ?? '' }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a class="btn btn-primary me-2 p-2-5"
                                            href="{{ url('/expense/edit/' . $exp->id) }}"><i class="fa fa-edit"></i> </a>
                                        {{-- <form method="post" action="{{ url('/expense/delete/' . $exp->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger p-2-5">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end align-items-end">
                <div class="mb-3 me-3">
                    <select id="perPage" name="perPage" class="form-select" onchange="changePerPage(this)">
                        <option value="5" @if ($perPage == 5) selected @endif>5</option>
                        <option value="10" @if ($perPage == 10) selected @endif>10</option>
                        <option value="15" @if ($perPage == 15) selected @endif>15</option>
                        <option value="25" @if ($perPage == 25) selected @endif>25</option>
                    </select>
                    <label for="perPage" class="form-label">Items per page:</label>

                </div>
                {{ $expense->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    <script>
        function changePerPage(select) {
            const perPage = select.value;
            window.location.href = `{{ url('expense') }}?perPage=${perPage}`;
        }
    </script>
@endsection
