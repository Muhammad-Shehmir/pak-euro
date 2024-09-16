@extends('layout.master')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center p-3 py-0">
            <h4 class="fw-bold py-3 mb-2"><a href="{{ url('dashboard') }}" class="text-muted fw-light">Dashboard </a>
                <span class="color">/
                    Room Availability
                </span>
            </h4>
        </div>
        <form method="GET" id="myForm" action="{{ url('/room-availability') }}" enctype="multipart/form-data"
            id="formValidationExamples">
            @csrf
            <div class="row p-3 py-0">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="date_from">Date From:</label>
                        <input type="date" class="form-control" id="date_from" name="date_from"
                            value="{{ request('date_from')  }}" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="date_to">Date To:</label>
                        <input type="date" class="form-control" id="date_to" name="date_to"
                            value="{{ request('date_to') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="room">Room:</label>
                        <select class="form-control" id="product_id" name="product_id">
                            <option value="">Select Room</option>
                            @foreach ($allproducts as $product)
                                <option value="{{ $product->id }}"
                                    {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end py-1 mt-2">
                    <button class="btn btn-secondary create-new btn-primary" tabindex="0" type="submit"><span><i
                                class="mdi mdi-magnify"></i>
                            <span class="d-none d-sm-inline-block">Search</span></span>
                    </button>
                    <a href="{{ url('/room-availability') }}" class="btn btn-danger" tabindex="0"><span><i
                        class="mdi mdi-close"></i>
                    <span class="d-none d-sm-inline-block">Clear</span></span></a>
                </div>
            </div>
        </form>
        {{-- <div class="container"> --}}
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="card-datatable table-responsive pt-0 p-3">
                        <table class="datatables-basic table table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        <h6> Room Name </h6>
                                    </th>
                                    <th>
                                        <h6> Price </h6>
                                    </th>
                                    <th>
                                        <h6> Availability </h6>
                                    </th>
                                    <th>
                                        <h6> Booking Dates </h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $availability[$product->id] }}</td>
                                        <td>
                                            @if ($availability[$product->id] == 'Booked' && $bookingDates[$product->id])
                                                {{ Carbon\Carbon::parse($bookingDates[$product->id][0])->format('d/M/Y') }}
                                                to
                                                {{ Carbon\Carbon::parse($bookingDates[$product->id][1])->format('d/M/Y') }}

                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        {{-- </div> --}}
    </div>
@endsection
