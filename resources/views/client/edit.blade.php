@extends('layout.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <form method="POST" action="{{ route('client.update', $client->id) }}" enctype="multipart/form-data">
            @csrf

            <div class="d-flex justify-content-between align-items-center p-3 py-0">
                <h4 class="fw-bold py-3 mb-2">
                    <a href="{{ url('/dashboard') }}" class="text-muted fw-light">Dashboard</a>
                    <a href="{{ url('/client') }}" class="text-muted fw-light">/ Client</a>
                    <span class="color">/</span>
                    <span class="text-heading fw-bold text-color"> Edit</span>
                </h4>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save & Close</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card invoice-preview-card">
                        <div class="container">
                            <h4 class="my-3 py-3">Edit Client</h4>
                        </div>

                        <hr class="my-0" />
                        <div class="card-body pt-0">
                            <div class="source-item pt-1">
                                <div class="mb-3">
                                    <div class="row">
                                        <!-- Form fields for customer details -->
                                        {{-- <div class="col-md-3 mb-3">
                                        <p class="mb-2">Customer Type</p>
                                        <div class="form-floating form-floating-outline">
                                            <select id="customer_type_id" name="customer_type_id" class="form-select">
                                                <option value="">Select</option>
                                                @foreach ($customer_types as $type)
                                                <option value="{{ $type->id }}" {{ $customer->customer_type_id ==
                                                    $type->id ? 'selected' : '' }}>
                                                    {{ $type->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <label for="customer_type_id">Customer Type</label>
                                        </div>
                                    </div> --}}
                                        <div class="col-md-4">
                                            <div class="form-floating form-floating-outline ">
                                                <div class="select2-primary">
                                                    <select data-placeholder="Select Client Type" id="type_id" required
                                                        name="type_id" class="select2 form-select-lg"
                                                        data-allow-clear="true">
                                                        <option value="">Select</option>
                                                        @foreach ($types as $type)
                                                            <option  {{ $client->type_id == $type->id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <label for="client_type">Client Type</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <p class="mb-2">Client Name</p>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Enter Name" value="{{ $client->name }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <p class="mb-2">Father Name</p>
                                            <input type="text" class="form-control" name="father_name"
                                                placeholder="Enter FatherName" value="{{ $client->father_name }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <p class="mb-2">Phone No</p>
                                            <input type="text" class="form-control" name="phone_no"
                                                placeholder="Enter Phone No." value="{{ $client->phone_no }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <p class="mb-2">Whatsapp No</p>
                                            <input type="text" class="form-control" name="whatsapp_no"
                                                placeholder="Enter Whatsapp No." value="{{ $client->whatsapp_no }}">
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <p class="mb-2">Email</p>
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Enter Email" value="{{ $client->email }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <p class="mb-2">Address</p>
                                            <textarea class="form-control" name="address" rows="3">{{ $client->address }}</textarea>
                                        </div>
                                        <div class="col-md-3 my-4">
                                            <div class="form-floating form-floating-outline ">
                                                <div class="select2-primary">
                                                    <select data-placeholder="Select Country" id="country_id"
                                                        name="country_id" class="select2 form-select-lg"
                                                        data-allow-clear="true">
                                                        <option value="">Select</option>
                                                        @foreach ($countries as $country)
                                                            <option
                                                                {{ $client->country_id == $country->id ? 'selected' : '' }}
                                                                value="{{ $country->id }}">{{ $country->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <label for="country">Country</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 my-4">
                                            <div class="form-floating form-floating-outline ">
                                                <div class="select2-primary">
                                                    <select data-placeholder="Select City" id="city_id" name="city_id"
                                                        class="select2 w-full" data-allow-clear="true">
                                                        <option value="">Select</option>
                                                        {{-- @foreach ($cities as $city)
                                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                                <label for="city">City</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <a href="{{ url('/client') }}" class="btn btn-label-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection

<script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script>
    $(document).ready(function() {

        var countryId = $('#country_id').val();
        fetchCitiesByCountry(countryId);

        function fetchCitiesByCountry(countryId) {
            if (countryId) {
                $.ajax({
                    url: '/api/get-cities/' + countryId,
                    type: 'GET',
                    success: function(data) {
                        var citiesDropdown = $('#city_id');
                        citiesDropdown.empty(); // Clear any existing options
                        citiesDropdown.append(
                            '<option value="">Select City</option>'); // Add default option

                        $.each(data.data, function(key, city) {
                            citiesDropdown.append('<option value="' + city.id + '">' + city
                                .name + '</option>');
                        });
                    },
                    error: function() {
                        console.log('response', 'error');
                    }
                });
            } else {
                var citiesDropdown = $('#city_id');
                citiesDropdown.empty(); // Clear the cities dropdown
                citiesDropdown.append('<option value="">Select City</option>'); // Add default option
            }
        }

        // Call the function on change event
        $('#country_id').change(function() {
            var countryId = $(this).val();
            fetchCitiesByCountry(countryId);
        });

    })
</script>
