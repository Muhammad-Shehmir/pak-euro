<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $client->name }} Ledger</title>
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
            font-size: 11px;
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

        @if ($client->type_id == 1)
            <table class="table">
                <thead>
                    <tr>
                        {{-- <th>S.No</th> --}}
                        <th>Date</th>
                        <th>Container No</th>
                        <th>Delivery Status</th>
                        <th>Delivery Party</th>
                        <th>Rate</th>
                        <th>Weight</th>
                        <th>Debit</th>
                        {{-- <th>Transport Charge</th> --}}
                        {{-- <th>Date</th> --}}
                        <th>EWAYBILL / INVC #</th>
                        <th>Credit</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalDebit = 0;
                        $totalCredit = 0;
                    @endphp
                    @foreach ($shipments as $index => $shipment)
                        <tr>
                            {{-- <td scope="row">{{ $index }}</td> --}}
                            <td scope="row">
                                {{ $shipment->date ? \Carbon\Carbon::parse($shipment->date)->format('d-F-Y') : '' }}
                            </td>
                            <td scope="row">{{ $shipment->imcont_no ?? '---' }}</td>
                            <td scope="row">
                                @if ($shipment->delivery_status == 1)
                                    <span>Delivered</span>
                                @elseif ($shipment->delivery_status == 2)
                                    <span>Pending</span>
                                @else
                                    <span>Rejected</span>
                                @endif
                            </td>
                            <td scope="row">{{ $shipment->delivery_party ?? '---' }}</td>
                            <td scope="row">
                                {{ number_format($shipment->carrying_rate, 2) ?? '0.00' }}</td>
                            <td scope="row">{{ number_format($shipment->quantity, 2) ?? '0.00' }}
                            </td>
                            <td scope="row">
                                {{ number_format($shipment->transaction->total_amount, 2) ?? '0.00' }}
                            </td>
                            {{-- <td scope="row">{{ number_format($shipment->transaction->total_amount, 2) ?? '0.00' }}</td> --}}
                            {{-- <td scope="row">
                                                    {{ \Carbon\Carbon::parse($shipment->transaction->date)->format('d-F-Y') ?? '' }}
                                                </td> --}}
                            <td scope="row">
                                {{ @$shipment->eway_bill . ' / ' . @$shipment->invoice_no }}</td>

                            @php
                                $totalPaidAmount = 0;
                            @endphp

                            @if (isset($shipment->transaction) && $shipment->transaction->payments->isNotEmpty())
                                @foreach ($shipment->transaction->payments as $payment)
                                    @php
                                        $totalPaidAmount += (int) $payment->amount_paid;
                                    @endphp
                                @endforeach
                            @endif

                            <td scope="row">{{ number_format($totalPaidAmount, 2) }}</td>
                        </tr>
                        @php
                            $totalDebit += (int) $shipment->transaction->total_amount;
                            $totalCredit += $totalPaidAmount;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td scope="row fw-bold" colspan="6">Total</td>
                        <td scope="row fw-bold" colspan="2">
                            {{ number_format($totalDebit, 2) ?? '0.00' }}</td>
                        <td scope="row fw-bold">
                            {{ number_format($totalCredit, 2) ?? '0.00' }}</td>
                    </tr>
                    <tr>
                        <td scope="row fw-bold" colspan="8">Total Balance Recievable / Payable</td>
                        <td scope="row fw-bold" colspan="3">
                            {{ number_format($totalDebit - $totalCredit, 2) ?? '0.00' }}</td>
                        {{-- <td scope="row fw-bold">
                                                {{ number_format($totalCredit, 2) ?? '0.00' }}</td> --}}
                    </tr>
                </tfoot>
            </table>
        @elseif($client->type_id == 2)
            <table class="table">
                <thead>
                    <tr>
                        {{-- <th>S.No</th> --}}
                        <th>Date</th>
                        <th>Container No</th>
                        <th>Delivery Status</th>
                        <th>Delivery Party</th>
                        <th>Rate</th>
                        <th>Weight</th>
                        <th>Debit</th>
                        {{-- <th>Transport Charge</th> --}}
                        {{-- <th>Date</th> --}}
                        <th>EWAYBILL / INVC #</th>
                        <th>Credit</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalDebit = 0;
                        $totalCredit = 0;
                    @endphp
                    @foreach ($shipments as $index => $shipment)
                        <tr>
                            {{-- <td scope="row">{{ $index }}</td> --}}
                            <td scope="row">
                                {{ $shipment->date ? \Carbon\Carbon::parse($shipment->date)->format('d-F-Y') : '' }}
                            </td>
                            <td scope="row">{{ $shipment->imcont_no ?? '---' }}</td>
                            <td scope="row">
                                @if ($shipment->delivery_status == 1)
                                    <span>Delivered</span>
                                @elseif ($shipment->delivery_status == 2)
                                    <span>Pending</span>
                                @else
                                    <span>Rejected</span>
                                @endif
                            </td>
                            <td scope="row">{{ $shipment->delivery_party ?? '---' }}</td>
                            <td scope="row">
                                {{ number_format($shipment->rate, 2) ?? '0.00' }}</td>
                            <td scope="row">{{ number_format($shipment->quantity, 2) ?? '0.00' }}
                            </td>
                            <td scope="row">
                                {{ number_format($shipment->bill->total_amount, 2) ?? '0.00' }}
                            </td>
                            {{-- <td scope="row">{{ number_format($shipment->bill->total_amount, 2) ?? '0.00' }}</td> --}}
                            {{-- <td scope="row">
                                                    {{ \Carbon\Carbon::parse($shipment->bill->date)->format('d-F-Y') ?? '' }}
                                                </td> --}}
                            <td scope="row">
                                {{ @$shipment->eway_bill . ' / ' . @$shipment->invoice_no }}</td>

                            @php
                                $totalPaidAmount = 0;
                            @endphp

                            @if (isset($shipment->bill) && $shipment->bill->payments->isNotEmpty())
                                @foreach ($shipment->bill->payments as $payment)
                                    @php
                                        $totalPaidAmount += (int) $payment->amount_paid;
                                    @endphp
                                @endforeach
                            @endif

                            <td scope="row">{{ number_format($totalPaidAmount, 2) }}</td>
                        </tr>
                        @php
                            $totalDebit += (int) $shipment->bill->total_amount;
                            $totalCredit += $totalPaidAmount;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td scope="row fw-bold" colspan="6">Total</td>
                        <td scope="row fw-bold" colspan="2">
                            {{ number_format($totalDebit, 2) ?? '0.00' }}</td>
                        <td scope="row fw-bold">
                            {{ number_format($totalCredit, 2) ?? '0.00' }}</td>
                    </tr>
                    <tr>
                        <td scope="row fw-bold" colspan="8">Total Balance Recievable / Payable</td>
                        <td scope="row fw-bold" colspan="3">
                            {{ number_format($totalDebit - $totalCredit, 2) ?? '0.00' }}</td>
                        {{-- <td scope="row fw-bold">
                                                {{ number_format($totalCredit, 2) ?? '0.00' }}</td> --}}
                    </tr>
                </tfoot>
            </table>
        @endif



    </div>
</body>

</html>
