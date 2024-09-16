@extends('layout.master')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center p-3 py-0">
            <h4 class="fw-bold py-3 mb-2"><a href="{{ url('dashboard') }}" class="text-muted fw-light">Dashboard </a>
                <span class="color">/
                    Booking
                </span>
            </h4>
            <a href="{{ url('get-beds24-bookings') }}" class="btn btn-primary">Sync</a>
        </div>
        <div class="card">
            {{-- <div class="card-header flex-column flex-md-row">
                <div class="head-label text-center">
                </div>
                <div class="dt-action-buttons pt-3 pt-md-0">
                    <div class="dt-buttons btn-group flex-wrap">
                        <a href="{{ url('/chart-of-account/add') }}" class="btn btn-secondary create-new btn-primary"
                            tabindex="0" aria-controls="DataTables_Table_0" type="button"><span><i
                                    class="mdi mdi-plus me-sm-1"></i>
                                <span class="d-none d-sm-inline-block">Add New</span></span></a>
                    </div>

                </div>
            </div> --}}
            <div class="card-datatable table-responsive p-3">
                <table class="datatables-basic table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <h6>ID</h6>
                            </th>
                            <th>
                                <h6>Arrival Time</h6>
                            </th>
                            <th>
                                <h6>Departure Time</h6>
                            </th>
                            <th>
                                <h6>Source</h6>
                            </th>
                            <th>
                                <h6>Name</h6>
                            </th>
                            <th>
                                <h6>Phone</h6>
                            </th>
                            <th>
                                <h6>Status</h6>
                            </th>
                            {{-- <th>
                                <h6>Actions</h6>
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->booking_start }}</td>
                                <td>{{ $data->booking_end }}</td>
                                <td>{{ $data->customer->customer_source }}</td>
                                <td>{{ $data->customer->name }}</td>
                                <td>{{ $data->customer->phone_no != null ? $data->customer->phone_no : '-' }}</td>
                                <td>{{ $data->status }}</td>
                                {{-- <td>{{ $data['id'] }}</td>
                                <td>{{ $data['arrival'] }}</td>
                                <td>{{ $data['departure'] }}</td>
                                <td>{{ $data['firstName'] }}</td>
                                <td>{{ $data['numAdult'] }}</td>
                                <td class="text-capitalize">{{ $data['status'] }}</td> --}}
                                {{-- <td>
                                    <div class="d-flex align-items-center">
                                        <a class="btn btn-primary me-2 p-2-5"
                                            href="{{ url('/booking/edit/' . $data->id) }}"><i class="fa fa-edit"></i> </a>
                                        <form method="post" action="{{ url('/booking/delete/' . $data->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger p-2-5">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
