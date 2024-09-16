@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <form action="{{ route('security.store') }}" method="POST">
            @csrf
            <div class="d-flex justify-content-between align-items-center p-3 py-0">
                <h4 class="fw-bold py-3 mb-2">
                    <a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard</a>
                    <a href="{{ url('/client-profile/' . request()->client_id) }}" class="text-muted fw-light">/ Security
                        Detail</a>
                    <span class="color">/</span>
                    <span class="text-heading fw-bold text-color"> Add</span>
                </h4>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save & Close</button>
                </div>
            </div>
            <div class="row invoice-add">
                <div class="col-md-12">
                    <div class="card invoice-preview-card">
                        <div class="card-body pb-0">
                            <h4 class="my-3">Add Security Detail</h4>
                            <div class="row mx-0">
                                <!-- Form fields for shipment details -->
                                <div class="col-md-4 mb-3">
                                    <p class="mb-2">Client Name</p>
                                    <select id="client_id" required name="client_id" type="text"
                                        class="select2 form-select form-select-lg" data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($clients as $client)
                                            <option {{ request()->client_id == $client->id ? 'selected' : '' }}
                                                value="{{ $client->id }}">
                                                {{ $client->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Type</p>
                                    <select id="type_id" name="type_id" type="text"
                                        class="select2 form-select form-select-lg" data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">
                                                {{ $type->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <p class="mb-2">Date</p>
                                    <input type="date" class="form-control" name="date" placeholder="Date"
                                        value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Token</p>
                                    <input type="text" class="form-control" name="token" placeholder="Token">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <p class="mb-2">Amount</p>
                                    <input type="number" class="form-control" name="amount" id="amount"
                                        placeholder="Amount">
                                </div>
                                {{-- <div class="col-md-3 mb-3">
                                    <p class="mb-2">Paid to</p>
                                    <select id="paid_to" name="paid_to" type="text"
                                        class="select2 form-select form-select-lg" data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">
                                                {{ $client->name }} </option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline my-2">
                                        <textarea class="form-control" name="description" rows="5" id="description"></textarea>
                                        <label for="description">Description</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
