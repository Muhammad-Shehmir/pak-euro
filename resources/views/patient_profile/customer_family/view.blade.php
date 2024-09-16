@extends('layout.master')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
@section('content')
    <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between py-3">
        <h4 class="fw-bold mb-0"><a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard / </a><a
                href="{{ url('/customer-profile' . '/' . $customer->id) }}" class="text-muted fw-light">Family Member </a><span class="color">/
                Profile
        </h4></span>
    </div>
    <div class="row">
        <!-- User Card -->
        <div class="card">

            <div class="card-body">

                <div class="user-avatar-section">
                    <div class="d-flex align-items-center flex-column">
                        <img class="rounded mb-3 mt-4" src="https://ui-avatars.com/api/?name={{ $family->name }}"
                            height="100" width="120" alt="User avatar" />
                        <div class="user-info text-center">
                            <h4>{{ $family->name }}</h4>
                            <span class="badge bg-label-primary">Family Member</span>
                        </div>
                    </div>
                </div>
                <div class="info-container">
                    <ul class="list-unstyled my-4 text-center">
                        <li class="mb-3">
                            <span class="fw-semibold text-heading">Status:</span>
                            @if ($family->status == 1)
                                <span class="badge bg-label-success">Active</span>
                            @else
                                <span class="badge bg-label-danger">InActive</span>
                            @endif
                        </li>
                        <li class="mb-3">
                            <span class="fw-semibold text-heading">Relation:</span>
                            <span>{{ $family->relation ? $family->relation->name : 'Family Head' }}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-semibold text-heading">Whatsapp No. :</span>
                            <span>{{ $family->whatsapp_no ?? '-' }}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-semibold text-heading">Gender:</span>
                            <span class="text-capitalize">{{ $family->gender ?? '-' }}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-semibold text-heading">DOB:</span>
                            <span>{{ Carbon\Carbon::parse($family->dob)->format('d-m-Y') ?? '-' }}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-semibold text-heading">Age:</span>
                            <span>{{ $family->age ?? '-' }} years</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-semibold text-heading">Email:</span>
                            <span>{{ $family->email ?? '-' }}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-semibold text-heading">Address :</span>
                            <span class="text-capitalize">{{ $family->address ?? '-' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /User Card -->
        <div class="col-12 mt-5">
            <a href="{{ url('/customer-profile' . '/' . $customer->id) }}" type="back"
                class="btn btn-label-secondary waves-effect">
                Back
            </a>
            <form action="{{ url('/patient/delete' . '/' . $customer->id . '/' . $family->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            {{-- <a href="{{ url('/patient/delete' . '/' . $customer->id . '/' . $family->id) }}"
                class="btn btn-danger">
                Delete
            </a> --}}
        </div>
    </div>
</div>
@endsection