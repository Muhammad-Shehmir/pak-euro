@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a href="{{ url('/expense') }}" class="text-muted fw-light">/ Expense</a><span class="color"> /</span><span class="text-heading fw-bold text-color"> Add</span>
        </h4>
        <div class="row">
            <!-- FormValidation -->
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Add New</h5>
                    <div class="card-body">
                        <form method="POST" id="myForm" action="{{ url('/expense/add') }}" enctype="multipart/form-data"
                            id="formValidationExamples" class="row g-3">
                            @csrf

                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <div class="form-floating form-floating-outline">
                                        <select required name="chart_of_account_id" class="select2 form-select form-select-lg">
                                            <option value="">Select</option>
                                            @foreach ($chartofaccount as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="chart_of_account_id">Chart Of Account</label>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-address" class="input-group-text"><i
                                            class="mdi mdi-account-details"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="description" type="text" id="basic-icon-default-address"
                                            class="form-control" placeholder="Enter Description" aria-label="Enter Description"
                                            aria-describedby="basic-icon-default-address" />
                                        <label for="basic-icon-default-address">Description</label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="mdi mdi-calendar"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="date" type="date" id="basic-icon-default-phone"
                                            class="form-control" placeholder="YYYY-MM-DD"
                                            aria-label="YYYY-MM-DD" aria-describedby="basic-icon-default-phone2" />
                                        <label for="basic-icon-default-phone">Date</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-address" class="input-group-text"><i
                                            class="mdi mdi-cash"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="amount" type="text" id="basic-icon-default-address"
                                            class="form-control" placeholder="Enter Amount" aria-label="Enter Amount"
                                            aria-describedby="basic-icon-default-address" />
                                        <label for="basic-icon-default-address">Amount</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <div class="form-floating form-floating-outline">
                                        <select required name="expense_category_id" type="text"
                                            class="select2 form-select form-select-lg" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($expensecategories as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="expense_category_id">Expense Category</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="input-group input-group-merge mb-2">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                      <textarea
                                      name="description"
                                        class="form-control h-px-75"
                                        aria-label="With textarea"
                                        placeholder="Enter Description"></textarea>
                                      <label>Description</label>
                                    </div>
                                  </div>
                            </div>
                            </div>
                            <div class="col-12">
                                <a href="{{ url('/expense') }}" type="back" class="btn btn-label-secondary waves-effect">
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
