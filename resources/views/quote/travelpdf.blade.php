<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BW - Travel Voucher - PDF</title>
    {{-- <link rel="stylesheet" href="style.css" /> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> --}}
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Roboto", sans-serif;
        }

        .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .border {
            border: 1px solid #dee2e6;
        }

        .border-bottom {
            border-bottom: 1px solid #dee2e6;
        }

        .p-2 {
            padding-right: 0.5rem;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .text-nowrap {
            white-space: nowrap;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table td,
        .table th {
            padding-right: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .fw-medium {
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="main" style="margin-left: 10%; margin-right: 10%">

        <!-- start logo -->
        <div style="margin-top: 5%;">
            <img width="150px" height="50px" style="margin-left: 38%" src="./blue-logo.png" alt="" />
        </div>
        <!-- end logo -->

        <!-- start heading 1 -->
        <div class="heading1" style="text-align: center; margin-top: 5%;">
            <h1>Travel Voucher</h1>
        </div>
        <!-- end heading 1 -->

        {{-- table start --}}
        <div class="table-responsive" style="margin-top: 5%;">
            <table class="table m-0 table-bordered">
                <thead>
                    <tr>
                        {{-- <th style="font-size: 12px !important; padding-right: 8px !important;">S.No</th> --}}
                        <th style="font-size: 14px !important; padding:5px !important;">Rooms</th>
                        <th style="font-size: 14px !important; padding:5px !important;">Nationality</th>
                        <th style="font-size: 14px !important; padding:5px !important;">Name</th>
                        <th style="font-size: 14px !important; padding:5px !important;">Room Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quote->quote_detail as $index => $item)
                        <tr>
                            {{-- <td style="font-size: 10px !important; padding-right:10px !important;">{{ $index + 1 }}
                            </td> --}}
                            @if ($index === 0)
                                <td rowspan="{{ count($quote->quote_detail) }}" style="font-size: 12px !important; padding:5px !important; text-align:center !important;">
                                    {{ $item->persons_rooms }}</td>
                            @endif
                            <td style="font-size: 12px !important; padding:5px !important; text-align:center !important; text-transform: capitalize !important;">
                                {{ $quote->origin }}</td>
                            <td style="font-size: 12px !important; padding:5px !important; text-align:center !important;">
                                {{ optional($quote->customer)->name }}</td>
                            <td style="font-size: 12px !important; padding:5px !important; text-align:center !important;">
                                {{ $item->product->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- table end --}}

        {{-- second table start --}}
        <div class="table-responsive" style="margin-top: 5%">
            <table class="table m-0 table-bordered">
                <tbody>
                    <tr>
                        <td style="font-size: 14px !important; padding:5px !important;"
                            class="text-end fw-bold">Address :</td>
                        <td style="font-size: 12px !important; padding:5px !important;" class="fw-bold">
                          {{ optional($quote->customer)->address }}</td>
                        <td style="font-size: 14px !important; padding:5px !important;"
                            class="text-end fw-bold">Date From:</td>
                        <td style="font-size: 12px !important; padding:5px !important;" class="fw-bold">
                          {{ Carbon\Carbon::parse($quote->date)->format('d/M/Y') }}</td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px !important; padding:5px !important;"
                            class="text-end fw-bold">E Mail :</td>
                        <td style="font-size: 12px !important; padding:5px !important;" class="fw-bold">
                          {{ optional($quote->customer)->email }}</td>
                        <td style="font-size: 14px !important; padding:5px !important;"
                            class="text-end fw-bold">Date To :</td>
                        <td style="font-size: 12px !important; padding:5px !important;" class="fw-bold">
                          {{ Carbon\Carbon::parse($quote->valid_till)->format('d/M/Y') }}</td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px !important; padding:5px !important;"
                            class="text-end fw-bold">Mobile Number :</td>
                        <td style="font-size: 12px !important; padding:5px !important;" class="fw-bold">
                          {{ optional($quote->customer)->phone_no }}</td>
                        <td style="font-size: 14px !important; padding:5px !important;"
                            class="text-end fw-bold">Meal Plan :</td>
                        <td style="font-size: 12px !important; padding:5px !important;" class="fw-bold">
                          {{ $quote->meal_plan }}</td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px !important; padding:5px !important;"
                            class="text-end fw-bold">Booking Dates :</td>
                        <td style="font-size: 12px !important; padding:5px !important;" class="fw-bold">
                          {{ Carbon\Carbon::parse($quote->date)->format('d/M/Y') }} - {{ Carbon\Carbon::parse($quote->valid_till)->format('d/M/Y') }}</td>
                        {{-- <td style="font-size: 10px !important; padding-right:10px !important;"
                            class="text-end fw-bold">No of Rooms :</td>
                        <td style="font-size: 10px !important; padding-right:10px !important;" class="fw-bold">
                          {{ $quote->meal_plan }}</td> --}}
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- second table end --}}

        {{-- third table start --}}
        <div class="table-responsive" style="margin-top: 10%;">
          <table class="table m-0 table-bordered">
              <thead>
                  <tr>
                      <th style="font-size: 14px !important; padding:5px !important;">Guesthouse Policies</th>
                      <th style="font-size: 14px !important; padding:5px !important;">Directions</th>
                  </tr>
              </thead>
              <tbody>
                    <tr>
                        <td style="font-size: 12px !important; padding:5px !important;">12 pm - 11 am is the Standard check in and check out time. <br>50 % refund for cancellations before 72 hours. <br>No refund for cancellations less than 72 hours</td>
                        <td style="font-size: 12px !important; padding:5px !important;">After collecting your luggage and exiting from the International terminal, <br>turn to your right and walk a bit further for 50 mtrs where you will find the <br>Guesthouse Policies domestic terminal to check in to your flight to Dharavandhoo. <br>Our staff will receive you at the airport when you land in Dharavandhoo</td>
                    </tr>
              </tbody>
          </table>
      </div>
      {{-- third table end --}}
        
        <!-- start business -->
        <div class="business" style="margin-top: 10%; text-align: center;">
            <div class="head">
                <h2 style="font-size: 32px;">Thanks in Advance for your Business</h2>
            </div>
            <div class="head"
                style="margin: 1.6%; border: 1px solid; background-color: dodgerblue; border: none; color: white; padding-top: 8px;">
                <h2 style="font-size: 32px;">Best Things
                    Happen at sea!!!</h2>
            </div>
        </div>
        <!-- End business -->

        <!-- start footer -->

        <div class="footr" style="margin-top: 5%; margin-bottom: 10%; color:  dodgerblue; text-align: center;">
            <h4>
                =================================================================================================================
            </h4>
            <div class="footer"
                style="font-size: 20px;">
                <div class="f1">
                    <a href="" style="color:  dodgerblue;">info@blueworlddharavandhoo.com</a>
                </div>
                <div class="f1">
                    <h4>Dharavandhoo, Baa Atoll, Maldives </h4>
                </div>
            </div>
            <div class="footer"
                style="font-size: 20px; margin-top: 4%; text-align: center;">
                <div class="f1">
                    <a href="" style="color: dodgerblue;">www.blueworldmaldives.com</a>
                </div>
                <div class="f1">
                    <h4>+960 7606 409, +960 9754 444 </h4>
                </div>
            </div>
            <h4>
                =================================================================================================================
            </h4>
            <!-- End footer -->
        </div>
    </div>
</body>

</html>
