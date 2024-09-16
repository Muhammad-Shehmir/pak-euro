@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a href="{{ url('/account-type') }}" class="text-muted fw-light">/ Account Type</a><span class="color"> /</span><span class="text-heading fw-bold text-color"> Edit</span>
        </h4>
        <div class="row">
            <!-- FormValidation -->
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Edit Account Type</h5>
                    <div class="card-body">
                        <form method="POST" id="myForm" action="{{ url('/account-type/edit/' . $account->id) }}"
                            enctype="multipart/form-data" id="formValidationExamples" class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="mdi mdi-account-outline"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" required class="form-control name-validate" id="basic-icon-default-fullname"
                                            placeholder="Enter Your Name" name="name" value="{{ $account->name }}"
                                            aria-label="Enter description" aria-describedby="basic-icon-default-fullname2" />
                                        <label for="basic-icon-default-fullname">Name</label>
                                    </div>
                                </div>
                                <span class="text-danger validation-name" style="display: none;">
                                    <i class="mdi mdi-alert"></i> Name is invalid
                                </span>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <div class="form-floating form-floating-outline">
                                        <select required name="nature" type="text" class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value="">Select</option>
                                            <option value="Expenses" @if ($account->nature === 'Expenses') selected @endif>Expenses</option>
                                            <option value="In Expenses" @if ($account->nature === 'In Expenses') selected @endif>In Expenses</option>
                                        </select>
                                        <label for="nature">Nature</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <div class="form-floating form-floating-outline">
                                        <select required name="category" type="text" class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value="">Select</option>
                                            <option value="Current Assets" @if ($account->category === 'Current Assets') selected @endif>Current Assets</option>
                                            <option value="In-Direct expenses" @if ($account->category === 'In-Direct expenses') selected @endif>In-Direct Expenses</option>
                                        </select>
                                        <label for="category">Category</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <div class="form-floating form-floating-outline">
                                        <select required name="general" type="text" class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value="">Select</option>
                                            <option value="Current Assets" @if ($account->general === 'Current Assets') selected @endif>Current Assets</option>
                                            <option value="In-Direct expenses" @if ($account->general === 'In-Direct expenses') selected @endif>In-Direct Expenses</option>
                                        </select>
                                        <label for="general">General</label>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">

                                    <div class="form-floating form-floating-outline">
                                        <select  required name="nature" type="text" class="select2 form-select form-select-lg"
                            data-allow-clear="true" value="{{ $account->nature }}">
                            <option value="">Select</option>
                            <option value="Expenses" >Expenses</option>
                            <option value="In Expenses" >In Expenses</option>

                        </select>
                        <label for="nature">Nature</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <div class="form-floating form-floating-outline">

                                    <select  required name="category" type="text" class="select2 form-select form-select-lg"
                                    data-allow-clear="true" value="{{ $account->category }}">
                                    <option value="">Select</option>
                                    <option value="Current Assets">Current Assets</option>
                                    <option value="In-Direct expenses">In-Direct Expenses</option>

                                </select>
                                <label for="category">Category</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">

                                    <div class="form-floating form-floating-outline">
                                        <select  required name="general" type="text" class="select2 form-select form-select-lg"
                                        data-allow-clear="true" value="{{ $account->general }}">
                                        <option value="">Select</option>
                                        <option value="Current Assets">Current Assets</option>
                                        <option value="In-Direct expenses">In-Direct Expenses</option>

                                    </select>
                                    <label for="general">General</label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <a href="{{ url('/account-type') }}" type="back" class="btn btn-label-secondary waves-effect">
                                    Back
                                </a>
                                <button type="submit" class="btn btn-primary submitBtn" id="submitBtn" >Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /FormValidation -->
        </div>
    </div>
@endsection
