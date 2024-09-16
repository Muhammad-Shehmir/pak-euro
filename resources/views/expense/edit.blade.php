@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard </a><a
                href="{{ url('/expense') }}" class="text-muted fw-light">/ Expense</a><span class="color"> /</span><span
                class="text-heading fw-bold text-color"> Edit</span>
        </h4>
        <div class="row">
            <!-- FormValidation -->
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Edit Expense</h5>
                    <div class="card-body">
                        <form method="POST" id="myForm" action="{{ url('/expense/edit/' . $expense->id) }}"
                            enctype="multipart/form-data" id="formValidationExamples" class="row g-3">
                            @csrf
                            <!-- Rest of your form code -->



                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <div class="form-floating form-floating-outline">
                                        <select required name="chart_of_account_id" type="text"
                                            class="select2 form-select form-select-lg" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($chartofaccount as $item)
                                                <option {{ $expense->chart_of_account_id == $item->id ? 'selected' : '' }}
                                                    value="{{ $item->id }}">{{ $item->name }}</option>
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
                                        value="{{ $expense->description }}"   class="form-control" placeholder="Enter Description" aria-label="Enter Description"
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
                                            value="{{ date('Y-m-d', strtotime($expense->date)) }}" class="form-control"
                                            placeholder="YYYY-MM-DD" aria-label="YYYY-MM-DD"
                                            aria-describedby="basic-icon-default-phone2" />

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
                                            value="{{ $expense->amount }}" class="form-control" placeholder="Enter Amount"
                                            aria-label="Enter Amount" aria-describedby="basic-icon-default-address" />
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
                                                <option {{ $expense->expense_category_id == $item->id ? 'selected' : '' }}
                                                    value="{{ $item->id }}">{{ $item->name }}</option>
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
                                            <textarea name="description" class="form-control h-px-75" aria-label="With textarea" placeholder="Enter Description">{{ $expense->description }}</textarea>
                                            <label>Description</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select name="account_type_id" type="text" class="select2 form-select form-select-lg"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($account_type as $item)
                                            <option {{ $chart->account_type_id == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="account_type_id">Account Type</label>
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select name="class_id" type="text" class="select2 form-select form-select-lg" data-allow-clear="true">
                                        <option value="">Select</option>
                                        <option value="1" @if ($chart->class_id == 1) selected @endif>class 1</option>
                                        <option value="2" @if ($chart->class_id == 2) selected @endif>class 2</option>
                                        <option value="3" @if ($chart->class_id == 3) selected @endif>class 3</option>
                                        <option value="4" @if ($chart->class_id == 4) selected @endif>class 4</option>
                                    </select>
                                    <label for="class_id">Class</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-address" class="input-group-text"><i
                                            class=""></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="credit_limit" type="text"
                                            id="basic-icon-default-address" class="form-control"
                                            placeholder="Enter Credit Limits" value="{{ $chart->credit_limit }}"
                                            aria-label="Enter Credit Limits"
                                            aria-describedby="basic-icon-default-address" />
                                        <label for="basic-icon-default-address">Credit Limits</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-address" class="input-group-text"><i
                                            class=""></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="credit_days" type="text" id="basic-icon-default-address"
                                            class="form-control" placeholder="Enter Credit Days"
                                            value="{{ $chart->credit_days }}" aria-label="Enter Credit Days"
                                            aria-describedby="basic-icon-default-address" />
                                        <label for="basic-icon-default-address">Credit Days</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-address" class="input-group-text"><i
                                            class=""></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input required name="debit" type="text" id="basic-icon-default-address"
                                            class="form-control" placeholder="Enter Debit" value="{{ $chart->debit }}"
                                            aria-label="Enter Debit" aria-describedby="basic-icon-default-address" />
                                        <label for="basic-icon-default-address">Debit</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-address" class="input-group-text"><i
                                            class=""></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input  name="ntn_no" type="number" id="basic-icon-default-address"
                                            class="form-control" placeholder="Enter NTN No."
                                            value="{{ $chart->ntn_no }}" aria-label="Enter NTN No."
                                            aria-describedby="basic-icon-default-address" />
                                        <label for="basic-icon-default-address">NTN No.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-2">
                                    <span id="basic-icon-default-address" class="input-group-text"><i
                                            class=""></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input  name="gst_no" type="number" id="basic-icon-default-address"
                                            class="form-control" placeholder="Enter GST No."
                                            value="{{ $chart->gst_no }}" aria-label="Enter GST No."
                                            aria-describedby="basic-icon-default-address" />
                                        <label for="basic-icon-default-address">GST No.</label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <a href="{{ url('/expense') }}" type="back"
                                    class="btn btn-label-secondary waves-effect">
                                    Back
                                </a>
                                <button type="submit" class="btn btn-primary submitBtn" id="submitBtn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /FormValidation -->
        </div>
    </div>
@endsection
