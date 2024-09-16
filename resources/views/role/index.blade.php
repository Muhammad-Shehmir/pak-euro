@extends('layout.master')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center p-3 py-0">
            <h4 class="fw-bold py-3 mb-2"><a href="{{ url('dashboard') }}" class="text-muted fw-light">Dashboard </a><span class="color">/ Role
            </h4></span>
            <button class="btn btn-secondary create-new btn-primary" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" tabindex="0"
                aria-controls="DataTables_Table_0" type="button"><span><i class="mdi mdi-filter-outline me-sm-1"></i>
                    <span class="d-none d-sm-inline-block">Filters</span></span></button>
        </div>


        <div class="card-body">


            <div class="col-18">

                <div class="card mb-4">


                    <div class="collapse" id="collapseExample">
                        <div class="row p-3 border">
                            <form method="GET" id="myForm" action="{{ url('/role') }}"
                                enctype="multipart/form-data" id="formValidationExamples">
                                @csrf
                                <div class="col-md-4">
                                    <div class="input-group input-group-merge mb-2">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="mdi mdi-account-star-outline"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text"  class="form-control" id="basic-icon-default-fullname"
                                                placeholder="Enter Role Name" name="title" aria-label="Enter Role Name" value="{{ request('title') }}"
                                                aria-describedby="basic-icon-default-fullname2" />
                                            <label for="basic-icon-default-fullname"> Role </label>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-md-7"> --}}


                                <div class="d-flex justify-content-end p-1 py-1">
                                    <button class="btn btn-secondary create-new btn-primary"  tabindex="0"
                                        type="submit"><span><i class="mdi mdi-magnify"></i>
                                            <span class="d-none d-sm-inline-block">Search</span></span></button>
                                    <a href="{{ url('/role') }}"    class="btn btn-danger" tabindex="0"
                                        ><span><i class="mdi mdi-close"></i>
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
                        <a href="{{ url('/role/add') }}" class="btn btn-secondary create-new btn-primary" tabindex="0"
                            aria-controls="DataTables_Table_0" type="button"><span><i class="mdi mdi-plus me-sm-1"></i>
                                <span class="d-none d-sm-inline-block">Add New</span></span></a>
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive pt-0 p-3">
                <table class="datatables-basic table table-bordered">
                    <thead>
                        <tr>
                            <th><h6>ID</h6></th>
                            <th><h6>Title</h6></th>
                            <th><h6>Actions</h6></th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->title }}</td>

                                <td>
                                             <div class="d-flex align-items-center">
                                        <a class="btn btn-primary me-2 p-2-5" href="{{ url('/role/edit/' . $role->id) }}"><i
                                                class="fa fa-edit"></i></a>
                                        <form method="post" action="{{ url('/role/delete/' . $role->id) }}">
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
            <div class="card-footer d-flex justify-content-end">
                <div class="mb-3">
                    <select id="perPage" name="perPage" class="form-select" onchange="changePerPage(this)">
                        <option value="5" @if($perPage == 5) selected @endif>5</option>
                        <option value="10" @if($perPage == 10) selected @endif>10</option>
                        <option value="15" @if($perPage == 15) selected @endif>15</option>
                        <option value="25" @if($perPage == 25) selected @endif>25</option>
                    </select>
                    <label for="perPage" class="form-label">Items per page:</label>
                </div>
                {{ $roles->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    <script>
        function changePerPage(select) {
            const perPage = select.value;
            window.location.href = `{{ url('role') }}?perPage=${perPage}`;
        }
    </script>
@endsection
