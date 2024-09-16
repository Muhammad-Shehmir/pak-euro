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
                    Date</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Chart of Account</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Expense Category</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Description</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Amount</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $expense)
                <tr>
                    <td style="font-size: 12px; text-align:center;">{{ $index + 1 ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">
                        {{ \Carbon\Carbon::parse($expense->date)->format('d M Y H:i a') ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $expense->chart_of_account->name ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $expense->expense_categories->name ?? '--' }}
                    </td>
                    <td style="font-size: 12px; text-align:center;">{{ $expense->description ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $expense->amount ?? '0' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $expense->created_at ?? '--' }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px;" colspan="5">
                    Total</td>
                <td
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    {{ $totalAmountSum }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
