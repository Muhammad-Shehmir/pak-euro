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
                BLUEWORLD SALES {{'FROM ' . $date_from . ' TO ' . $date_to}}
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
                    Name.</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Room Name</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Gross Amount</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Green Tax</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    GST</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Service Charge</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Credit Card Charges</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Net Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $transactions)
                <tr>
                    <td style="font-size: 12px; text-align:center;">{{ $index + 1 ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $transactions->customer->name ?? '--' }}
                    </td>
                    <td style="font-size: 12px; text-align:center;">{{ implode(', ', $transactions->product_names) ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $transactions->sub_total ?? '0' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $transactions->total_green_tax_amount ?? '0' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $transactions->total_tax_amount ?? '0' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $transactions->total_service_charge_amount ?? '0' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $transactions->card_charges_amount ?? '0' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $transactions->total_amount ?? '0' }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="font-weight: 600; border:2px solid #000; text-align: right; font-size: 14px; width: 200px !important;"
                    colspan="3">
                    Total
                </td>
                <td
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    {{ '$' .  $grossAmountSum }}</td>
                <td
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    {{ '$' .  $totalGreenTaxSum }}</td>
                <td
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    {{ '$' .  $totaltaxSum }}</td>
                <td
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    {{ '$' .  $totalServiceChargeSum }}</td>
                <td
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    {{ '$' .  $totalCardChargesSum }}</td>
                <td
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    {{ '$' .  $totalAmountSum }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
