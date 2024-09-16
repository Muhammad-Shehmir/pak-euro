@extends('layout.master')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center p-3 py-0">
            <h4 class="fw-bold py-3 mb-2"><a href="{{ url('dashboard') }}" class="text-muted fw-light">Dashboard </a><span class="color">/ Doctor
                Timing
            </h4></span>

        </div>


        <!-- DataTable with Buttons -->
        <div class="card">
            <form action="{{ url('/doctor-timing/save') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-header flex-column flex-md-row">
                    <div class="dt-action-buttons pt-3 pt-md-0">
                        <h4>Timings</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline my-3">
                                    <select id="doctor" required name="doctor_id" type="text" onchange="getDoctorId()"
                                        class="select2 form-select form-select-lg" data-allow-clear="true">
                                        <option value="">Select</option>
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="doctors">Doctors</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-datatable table-responsive pt-0 p-3">
                    <table class="datatables-basic table">
                        <thead>
                            <tr>
                                <th>
                                    <h6>AVAILABLE</h6>
                                </th>
                                <th>
                                    <h6>DAY</h6>
                                </th>
                                <th>
                                    <h6>START TIME.</h6>
                                </th>
                                <th>
                                    <h6>END TIME</h6>
                                </th>
                                <th>
                                    <h6>DURATION</h6>
                                </th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($days as $day)
                                <tr>
                                    <td>
                                        <input id="status_{{ $day->id }}" class="form-check-input doctorTimingStatus"
                                            value="0" type="checkbox" name="status_{{ $day->id }}" />
                                    </td>

                                    <td>{{ $day->name }}</td>
                                    <td><input type="time" id="start_time_{{ $day->id }}" class="form-control"
                                            name="start_time_{{ $day->id }}" />
                                    </td>
                                    <td><input type="time" id="end_time_{{ $day->id }}" class="form-control"
                                            name="end_time_{{ $day->id }}" />
                                    </td>
                                    <td><input type="text" id="duration_{{ $day->id }}" class="form-control"
                                            name="duration_{{ $day->id }}" />
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
                <div class="modal-footer p-3 pt-0">
                    <button type="submit" class="btn btn-primary submitBtn" id="submitBtn">Save</button>
                </div>
                {{-- <div class="card-footer d-flex justify-content-end">
                {{ $doctor_timing->links('pagination::bootstrap-4') }}
            </div> --}}
            </form>
        </div>
    </div>

    <script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.doctorTimingStatus').change(function() {
                $(this).val(this.checked ? 1 : 0);

                var $row = $(this).closest('tr');
                var $inputs = $row.find('input[type="text"],input[type="time"]');

                $inputs.prop('required', this.checked);
            });

        });

        function getDoctorId() {
            var select = document.getElementById("doctor");
            var selectedDoctorId = select.options[select.selectedIndex].value;

            $.ajax({
                type: "POST",
                data: {
                    "id": selectedDoctorId,
                },
                url: "{{ url('api/doctorTiming/getById') }}",
                dataType: 'json',
                success: function(result) {
                    var data = result.data;

                    if (data && data.length > 0) {
                        data.forEach(detail => {
                            var statusInput = document.getElementById("status_" + detail.day_id);
                            var startTimeInput = document.getElementById("start_time_" + detail.day_id);
                            var endTimeInput = document.getElementById("end_time_" + detail.day_id);
                            var durationInput = document.getElementById("duration_" + detail.day_id);

                            if (statusInput) {
                                if (detail.status == 1) {
                                    statusInput.checked = true;
                                    statusInput.value = detail.status;
                                } else {
                                    statusInput.checked = false;
                                }
                            }
                            if (startTimeInput) {
                                startTimeInput.value = detail.start_time;
                            }
                            if (endTimeInput) {
                                endTimeInput.value = detail.end_time;
                            }
                            if (durationInput) {
                                durationInput.value = detail.duration;
                            }
                        });
                    } else {
                        var inputs = document.querySelectorAll(
                            'input[type="checkbox"], input[type="time"], input[type="text"]');
                        inputs.forEach(input => {
                            input.value = null;
                            if (input.type === "checkbox") {
                                input.checked = false;
                            }
                        });
                    }

                }
            })
        };
    </script>
@endsection
