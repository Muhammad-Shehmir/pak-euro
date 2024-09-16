<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $client->name }} Security Ledger</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <style>
        @media print {
            table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            .no-print {
                display: none;
            }
        }

        @media print {
            @page {
                size: A4;
                margin: 0;
            }

            .container {
                width: 100%;
                margin: 0;
                padding: 0;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 4px;
            }
        }

        @media print {
            .container {
                width: 100%;
                margin: 0;
            }

            table {
                page-break-inside: auto;
                width: 100%;
            }

            th,
            td {
                page-break-inside: avoid;
            }

            @page {
                size: auto;
                margin: 0;
            }
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: system-ui
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
            margin-top: 1%;

        }

        th,
        td {
            border: 1px solid black;
            padding: 4px;
            text-align: left;

        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</head>

<body>
    <div class="container" style="margin: 20px 30px; width: 94%;">
        <div class="logo-heading"
            style="display: flex;justify-content: space-between;align-items: center;text-align: center;">
            <div class="logo">
                <img src="{{ url('/pak_euro.png') }}" alt=""
                    style="width: 130px; border: 1px solid rgb(148, 144, 144); border-left: none;border-right: none; padding-bottom: 8px;border-top: none;">
                <h1>PAK EURO</h1>
            </div>
            <div class="client-details" style="text-align: right;">
                <h2>{{ $client->name }}</h2>
                <p>{{ $client->address }}</p>
                {{-- <p>Phone: {{ $client->phone }}</p>
                <p>Email: {{ $client->email }}</p> --}}
            </div>
        </div>
        {{-- <div style="margin-left: 90%;margin-top: 2%;"><b>LEDGER:</b></div> --}}

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Token</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($security_details as $index => $security_detail)
                    <tr>
                        <td scope="row">
                            {{ $security_detail->date ? \Carbon\Carbon::parse($security_detail->date)->format('d-F-Y') : '' }}
                        </td>
                        <td scope="row">
                            {{ $security_detail->description ?? '---' }}
                        </td>
                        <td scope="row">
                            {{ $security_detail->token ?? '---' }}
                        </td>
                        <td scope="row">
                            @if ($security_detail->type_id == 1)
                                {{ number_format($security_detail->amount, 2) ?? '0.00' }}
                            @else
                                {{ number_format(-$security_detail->amount, 2) ?? '0.00' }}
                            @endif
                        </td>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td scope="row fw-bold" colspan="3">Total</td>
                    <td scope="row fw-bold">
                        {{ number_format($totalSecurityAmount, 2) ?? '0.00' }}</td>
                </tr>
            </tfoot>

            </tbody>
        </table>



    </div>
</body>

</html>
