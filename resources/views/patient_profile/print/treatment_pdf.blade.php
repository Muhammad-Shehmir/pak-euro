<!DOCTYPE html>

<html
  lang="en"
  class="light-style"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="horizontal-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>PDC - Treatment - PDF</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('/PDC-01.jpg') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/materialdesignicons.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />

    <!-- Page CSS -->

    <link rel="stylesheet" href="../../assets/vendor/css/pages/app-invoice-print.css" />
    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="invoice-print p-4">
      <div class="d-flex justify-content-between flex-row">
        <div class="mb-xl-0 pb-3">
            <img src="{{ url('/PDC-01.png') }}" width="150px" height="100px">
            <h4>PATEL DENTAL CLINIC</h4>
            <p class="mb-1"><i class="mdi mdi-map-marker me-2"></i>Suite#7, 128-U Mono tower, Allama
            </p>

            <p class="mb-1"><i class="me-4" style="padding-left: 3px"></i>Iqbal off Tariq Road,
                PECHS Block
                2</p>
            <p class="mb-0"><i class="mdi mdi-phone me-2"></i>02134555141, 03219257079</p>
        </div>
        <div style="margin-top: 30px">
            <h5>INVOICE #86423</h5>
            <div class="mb-1">
                <span>Date Issues:</span>
                <span>December 25, 202_</span>
            </div>
            <div>
                <span>Date Due:</span>
                <span>January 25, 202_</span>
            </div>
        </div>
      </div>

      <hr />

      <div class="d-flex justify-content-between mb-4">
        <div class="my-2">
            <h6 class="pb-2">Invoice To:</h6>
            <p class="mb-1"><b>Name:</b> XYZ</p>
            <p class="mb-1"><b>MR#:</b> 10102</p>
            <p class="mb-0"><b>Phone No:</b> 02030344</p>
            <p class="mb-0"><b>Gender:</b>Male</p>
        </div>
        <div class="my-2">
          <h6>Bill To:</h6>
          <table>
            <tbody>
                <tr>
                    <td class="pe-3 fw-medium">Name:</td>
                    <td>Male</td>
                </tr>
                <tr>
                    <td class="pe-3 fw-medium">MR#:</td>
                    <td>10102</td>
                </tr>
                <tr>
                    <td class="pe-3 fw-medium">Phone No:</td>
                    <td>02030344</td>
                </tr>
                <tr>
                    <td class="pe-3 fw-medium">Gender:</td>
                    <td>Male</td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table m-0">
          <thead class="table border-top"  style="background-color: #3b91e1 !important; color:black">
            <tr>
                <th>Description</th>
                <th>Rate</th>
                <th>Quantity</th>
                <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td class="text-nowrap">Test</td>
                <td class="text-nowrap">25</td>
                <td>32</td>
                <td>1000</td>
            </tr>

          </tbody>
        </table>
        <div class="d-flex justify-content-between flex-row mt-3">
            <div class="mb-4" style="margin-top: 15px; margin-left:15px;">
                <div class="pt-10">
                    <p class="mb-1"><b>Date:</b> 28/10/2023</p>
                    <p class="mb-1"><b>Payment Mode:</b> Cash</p>
                </div>
            </div>
            <div class="pt-12" style="margin-top: 15px; margin-right:15px;">
                <p class="mb-1"><b>Sub - Total:</b> Rs. 130000.00</p>
                <p class="mb-1"><b>Discount:</b> Rs. 13000.00</p>
                <p class="mb-1"><b>Grand Total: Rs. 117,000.0/-</b></p>

            </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          {{-- <span class="fw-bold">Note:</span>
          <span
            >It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance
            projects. Thank You!</span
          > --}}
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

  </body>
</html>
