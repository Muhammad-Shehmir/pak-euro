<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ url('assets/') }}" data-template="horizontal-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Portal - FC </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('/PDC-01.jpg') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('assets/vendor/fonts/materialdesignicons.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/fonts/fontawesome.css') }}" />
    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/node-waves/node-waves.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/css/rtl/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/fullcalendar/fullcalendar.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/quill/editor.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/dropzone/dropzone.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ url('/assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ url('assets/vendor/css/pages/app-calendar.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/css/pages/cards-statistics.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/css/pages/cards-analytics.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">


</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">

            @include('layout.topbar')

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">

                    @include('layout.webmenu')

                    @yield('content')

                    @include('layout.footer')
                    <div class="content-backdrop fade"></div>
                </div>
                <!--/ Content wrapper -->
            </div>

            <!--/ Layout container -->
        </div>
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

    <!--/ Layout wrapper -->

    <!-- Core JS -->
    <!-- Helpers -->
    <script src="{{ url('assets/vendor/js/helpers.js') }}"></script>
    {{-- <script src="{{ url('assets/vendor/js/template-customizer.js') }}"></script> --}}
    <script src="{{ url('assets/js/config.js') }}"></script>

    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ url('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ url('assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ url('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ url('assets/vendor/libs/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/dropzone/dropzone.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ url('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ url('assets/js/app-calendar-events.js') }}"></script>
    <script src="{{ url('assets/js/app-calendar.js') }}"></script>
    <script src="{{ url('assets/js/dashboards-analytics.js') }}"></script>
    <script src="{{ url('assets/js/forms-selects.js') }}"></script>
    <script src="{{ url('assets/js/custom-validation.js') }}"></script>
    <script src="{{ url('assets/js/forms-file-upload.js') }}"></script>
    <script src="{{ url('assets/js/form-wizard-icons.js') }}"></script>

    <script src="{{ url('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/pickr/pickr.js') }}"></script>
    <script src="{{ url('assets/js/forms-pickers.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ url('/assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ url('/assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ url('/assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"
        integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('[data-inputmask]').inputmask();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle form submission for all forms
            $('form').on('submit', function() {
                // Disable the submit button within the form to prevent multiple submissions
                $(this).find('.submitBtn').prop('disabled', true);

                // Allow form submission to continue
                return true;
            });

            // $('.select2').select2({
            //     placeholder: 'Please Select',
            //     allowClear: true,
            //     width: '100%'
            // });
        });
    </script>

    @if (session()->has('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: {!! json_encode(session('success')) !!},
                showConfirmButton: false,
                timer: 2500
            }).then(() => {
                @php
                    session(['success' => null]);
                @endphp
            });
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: {!! json_encode(session('error')) !!},
                showConfirmButton: false,
                timer: 2500
            }).then(() => {
                @php
                    session(['error' => null]);
                @endphp
            });
        </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

    <script>
        var $ = jQuery.noConflict();

        function initializeTomSelect(selector) {
            try {
                var dropdown = new TomSelect(selector, {});
            } catch (error) {
                console.error('TomSelect initialization error:', error);
            }
        }
        initializeTomSelect('#patient');
        initializeTomSelect('#relation_id');
        initializeTomSelect('.tom-sel');
    </script>


</body>

</html>
