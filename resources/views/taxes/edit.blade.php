@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light ">Dashboard </a><a href="{{ url('/tax') }}" class="text-muted fw-light">/ Tax</a><span class="color"> /</span><span class="text-heading fw-bold text-color"> Edit</span>
        </h4>
        <div class="row">
            <!-- FormValidation -->
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Edit Tax</h5>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/tax/edit/' . $tax->id) }}" enctype="multipart/form-data"
                            id="formValidationExamples" class="row">
                            @csrf
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="mdi mdi-format-align-left"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" required class="form-control" id="basic-icon-default-fullname"
                                            placeholder="Enter description" name="description"
                                            value="{{ $tax->description }}" aria-label="Enter description"
                                            aria-describedby="basic-icon-default-fullname2" />
                                        <label for="basic-icon-default-fullname"> Description</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-percent-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="tax" type="decimal" id="basic-icon-default-phone"
                                            class="form-control phone-mask" placeholder="Enter Tax"
                                            value="{{ $tax->tax }}" aria-label="Enter tax."
                                            aria-describedby="basic-icon-default-phone2" />
                                        <label for="basic-icon-default-phone">Tax</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 pt-3">
                                <a href="{{ url('/tax') }}" type="back" class="btn btn-label-secondary waves-effect">
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
