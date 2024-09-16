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
            <th colspan="8"
                style="text-align: center; font-weight: bold; font-size: 16px; border: 2px solid #000;">
                Security Detail
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
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Date</th>
                <th colspan="4"
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Description</th>
                <th colspan="2"
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Token</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $security_detail)
                <tr>
                    <td style="font-size: 12px; text-align:center;">
                        {{ $security_detail->date ? \Carbon\Carbon::parse($security_detail->date)->format('d-F-Y') : '' }}</td>
                    <td style="font-size: 12px; text-align:center;" colspan="4">
                        {{ $security_detail->description ?? '---' }}</td>
                    <td style="font-size: 12px; text-align:center;" colspan="2">
                        {{ $security_detail->token ?? '---' }}</td>
                    <td style="font-size: 12px; text-align:center;" colspan="2">
                        {{ number_format($security_detail->amount, 2) ?? '0' }}</td>
                    
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="font-weight: 600; border:2px solid #000; text-align: left; font-size: 14px; width: 200px !important;"
                    colspan="7">
                    Total
                </td>
                <td style="font-weight: 600; border:2px solid #000; font-size: 14px; width: 200px !important;">
                    {{ number_format($total, 2) }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
