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
            <td colspan="7" style="text-align: center; font-weight: bold; font-size: 16px; border: 2px solid #000;">
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
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Patient Age</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Phone No.</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Whatsapp No.</th>
                <th
                    style="font-weight: 600; border:2px solid #000; text-align: center; font-size: 14px; width: 200px !important;">
                    Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $patient)
                <tr>
                    <td style="font-size: 12px; text-align:center;">{{ $index + 1 ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $patient->mr_number ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $patient->name ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $patient->age ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $patient->phone_no ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">{{ $patient->whatsapp_no ?? '--' }}</td>
                    <td style="font-size: 12px; text-align:center;">
                        {{ $patient->created_at ? $patient->created_at : $patient->created_at_reference }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
