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
            <td colspan="4" style="text-align: center; font-weight: bold; font-size: 16px; border: 2px solid #000;">
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
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 400px !important;">
                    Procedure</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Price</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $procedure)
                <tr>
                    <td style="font-size: 12px; text-align:center;">{{ $index + 1 ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $procedure->name ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">Rs. {{ $procedure->price ?? '0' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $procedure->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
