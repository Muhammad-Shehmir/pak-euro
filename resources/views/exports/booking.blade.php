<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>


    <table class="table table-bordered">
        <tr>
            <td colspan="11" style="text-align: center; font-weight: bold; font-size: 16px; border: 2px solid #000;">
                BLUEWORLD BOOKING {{ 'FROM ' . $date_from . ' TO ' . $date_to }}
            </td>
        </tr>
        <tr></tr>
        <thead>
            <tr>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    S.No</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Check In Date.</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Check Out Date</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Name</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Room Name</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    No. Of Nights</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $booking)
                <tr>
                    <td style="font-size: 12px; text-align:center;">{{ $index + 1 ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">
                        {{ \Carbon\Carbon::parse($booking->booking_start)->format('d M Y H:i a') ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">
                        {{ \Carbon\Carbon::parse($booking->booking_end)->format('d M Y H:i a') ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $booking->customer->name ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $booking->product->name ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $booking->no_of_nights ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $booking->total_amount ?? '0' }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="font-weight: 600; border:2px solid #000; text-align: right; font-size: 14px; width: 200px !important;"
                    colspan="6">
                    Total
                </td>
                <td
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    {{ '$' . $totalAmountSum }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
