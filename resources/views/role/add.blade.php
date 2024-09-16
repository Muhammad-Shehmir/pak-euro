@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a href="{{ url('/role') }}" class="text-muted fw-light">/ Role</a><span class="color"> /</span><span class="text-heading fw-bold text-color"> Add</span></h4>
        <div class="row">
            <!-- FormValidation -->
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Add Role</h5>
                    <div class="card-body">
                        <form method="POST" id="myForm" action="{{ url('/role/add') }}" enctype="multipart/form-data"
                            id="formValidationExamples" class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="mdi mdi-account-star-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" required class="form-control" id="basic-icon-default-fullname"
                                            placeholder="Enter Role Name" name="title" aria-label="Enter Role Name"
                                            aria-describedby="basic-icon-default-fullname2" />
                                        <label for="basic-icon-default-fullname"> Role </label>
                                    </div>
                                </div>
                            </div>
                            @foreach ($permissions as $permission)
                                <div class="bg-light-primary rounded-2">
                                    <h6 class="my-2 ms-2">{{ $permission->pluck('group_by')->first() }}</h6>
                                </div>
                                <div class="row row-bordered g-0">
                                    @foreach ($permission as $detail)
                                        <div class="col-md-3 pt-0 p-3">
                                            <div class="form-check mt-3">
                                                <input class="form-check-input" type="checkbox" value="{{ $detail->id }}"
                                                    id="permission-{{ $detail->id }}" name="permissions[]" />
                                                <label class="form-check-label text-capitalize"
                                                    for="permission-{{ $detail->id }}">
                                                    {{ str_replace('_', ' ', explode('-', $detail->title)[0]) }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                            <div class="col-12">
                                <a href="{{ url('/role') }}" type="back" class="btn btn-label-secondary waves-effect">
                                    Back
                                </a>
                                <button type="submit" class="btn btn-primary submitBtn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /FormValidation -->
        </div>
    </div>
@endsection
