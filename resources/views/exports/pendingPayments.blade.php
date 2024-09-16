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
                PATEL DENTAL CLINIC
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
                    Patient Mr No.</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Patient Name</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 400px !important;">
                    Procedures</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Total Amount</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Amount Paid</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Balance Amount</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $pending_payment)
                <tr>
                    <td style="font-size: 12px; text-align:center;">{{ $index + 1 ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $pending_payment->patient->mr_number ?? '--' }}
                    </td>
                    <td style="font-size: 12px; text-align:center;">{{ $pending_payment->patient->name ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">
                        {{ implode(', ', $pending_payment->procedure_names) ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $pending_payment->total_amount ?? '0' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $pending_payment->payment ?? '0' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $pending_payment->due_amount ?? '0' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $pending_payment->created_at ?? '--' }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="font-weight: 600; border:2px solid #000; text-align: right; font-size: 14px; width: 200px !important;"
                    colspan="4">
                    Total
                </td>
                <td
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    {{ $totalAmountSum }}</td>
                <td
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    {{ $totalPaymentAmountSum }}</td>
                <td
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    {{ $totalDueAmountSum }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
