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
            <th colspan="11"
                style="text-align: center; font-weight: bold; font-size: 16px; border: 2px solid #000; background-color: #02026d !important;">
                SURAT TRADERS(23-24)
            </th>
        </tr>
        <tr></tr>
        {{-- <tr>
            <td style="font-weight: 600; border:2px solid #000; text-align: right; font-size: 14px; width: 200px !important;">
                Total Received
            </td>
            <td
                style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                {{ 'PKR ' . number_format($totalReceipts, 2) ?? '0.00' }}</td>
            <td style="font-weight: 600; border:2px solid #000; text-align: right; font-size: 14px; width: 200px !important;">
                Total Paid
            </td>
            <td
                style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                {{ 'PKR ' . number_format($totalPayments, 2) ?? '0.00' }}</td>
            <td style="font-weight: 600; border:2px solid #000; text-align: right; font-size: 14px; width: 200px !important;">
                Balance
            </td>
            <td
                style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                {{ 'PKR ' . number_format($balanceReceipt, 2) ?? '0.00' }}</td>
        </tr> --}}
        <thead>
            <tr>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important; color: white; background-color: blue;">
                    S.No</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important; color: white; background-color: blue;">
                    Date</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important; color: white; background-color: blue;">
                    Container No</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important; color: white; background-color: blue;">
                    Delivery Status</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important; color: white; background-color: blue;">
                    Delivery Party</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important; color: white; background-color: blue;">
                    Rate</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important; color: white; background-color: blue;">
                    Weight</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important; color: white; background-color: blue;">
                    Debit</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important; color: white; background-color: blue;">
                    Date</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important; color: white; background-color: blue;">
                    EWAYBILL / INVC #</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important; color: white; background-color: blue;">
                    Credit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $shipment)
                <tr>
                    <td style="font-size: 12px; text-align:center;">{{ $index + 1 ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">
                        {{ $shipment->date ? \Carbon\Carbon::parse($shipment->date)->format('d-F-Y') : '' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $shipment->imcont_no ?? '---' }}</td>
                    <td style="font-size: 12px; text-align:center;">
                        @if ($shipment->delivery_status == 1)
                            <span>Delivered</span>
                        @elseif ($shipment->delivery_status == 2)
                            <span>Pending</span>
                        @else
                            <span>Rejected</span>
                        @endif
                    </td>
                    <td style="font-size: 12px; text-align:center;">
                        {{ $shipment->client->name ?? '---' }}</td>
                    <td style="font-size: 12px; text-align:center;">
                        {{ number_format($shipment->carrying_rate, 2) ?? '0.00' }}</td>
                    <td style="font-size: 12px; text-align:center;">
                        {{ number_format($shipment->quantity, 2) ?? '0.00' }}
                    </td>
                    <td style="font-size: 12px; text-align:center;">
                        {{ number_format($shipment->transaction->total_amount, 2) ?? '0.00' }}</td>
                    <td style="font-size: 12px; text-align:center;">
                        {{ \Carbon\Carbon::parse($shipment->transaction->date)->format('d-F-Y') ?? '' }}</td>
                    <td style="font-size: 12px; text-align:center;">
                        {{ @$shipment->eway_bill . ' / ' . @$shipment->invoice_no }}
                    <td style="font-size: 12px; text-align:center;">{{ number_format($totalCredit, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="font-weight: 600; border:2px solid #000; text-align: left; font-size: 14px; width: 200px !important;"
                    colspan="7">
                    Total
                </td>
                <td style="font-weight: 600; border:2px solid #000; font-size: 14px; width: 200px !important;"
                    colspan="3">
                    {{ number_format($totalDebit, 2) }}</td>
                <td
                    style="font-weight: 600; border:2px solid #000; text-align: right; font-size: 14px; width: 200px !important;">
                    {{ number_format($totalCredit, 2) }}
                </td>
            </tr>
            <tr>
                @if ($balance != 0)
                    <td style="font-weight: 600; border:2px solid #000; text-align: right; font-size: 14px; width: 200px !important;"
                        colspan="10">
                        Balance
                    </td>
                    <td style="font-weight: 600; border:2px solid #000; text-align: right; font-size: 14px; width: 200px !important;">
                        {{ number_format($balance, 2) }}
                    </td>
                @elseif ($advance != 0)
                    <td style="font-weight: 600; border:2px solid #000; text-align: right; font-size: 14px; width: 200px !important;"
                        colspan="10">
                        Advance
                    </td>
                    <td style="font-weight: 600; border:2px solid #000; text-align: right; font-size: 14px; width: 200px !important;">
                        {{ number_format($advance, 2) }}
                    </td>
                @endif
            </tr>
        </tfoot>
    </table>

</body>

</html>
