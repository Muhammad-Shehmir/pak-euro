<?php

namespace App\Exports;

use App\Models\Appointment;
use App\Models\Appointments;
use App\Models\Booking;
use App\Models\Logs;
use App\Models\ReceiptPayment;
use App\Models\Shipment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Carbon\Carbon;


class LedgerExport implements FromView, WithCustomStartCell
{
    /**
     * @return \Illuminate\Support\Collection
     */

    // public $date_from = null;
    // public $date_to = null;

    public function __construct($params)
    {
        // $this->date_from = isset($params['date_from']) ? Carbon::parse($params['date_from'])->startOfDay()->format('Y-m-d') : Carbon::now()->startOfMonth()->format('Y-m-d');
        // $this->date_to = isset($params['date_to']) ? Carbon::parse($params['date_to'])->endOfDay()->format('Y-m-d') : Carbon::now()->format('Y-m-d');
    }

    public function startCell(): string
    {
        return 'A8';
    }

    public function view(): View
    {
        // $date_from = $this->date_from;
        // $date_to = $this->date_to;

        // $res = Booking::when($date_from, function ($query) use ($date_from) {
        //     $query->where('booking_start', '>=', $date_from);
        // })
        // ->when($date_to, function ($query) use ($date_to) {
        //     $query->where('booking_end', '<=', $date_to);
        // })->get();

        // $totalAmountSum = $res->sum('total_amount') ?? 0;

        // $receipt_payments = ReceiptPayment::all();
        $shipments = Shipment::all();

        $totalDebit = 0;
        $totalCredit = 0;

        foreach ($shipments as $shipment) {
            $totalDebit += $shipment->transaction->total_amount;
            foreach ($shipment->transaction->payments as $payment) {
                $totalCredit += $payment->amount_paid;
            }
        }

        $balance = $totalDebit - $totalCredit;
        $advance = 0;

        if ($balance < 0) {
            $advance = abs($balance); // Store positive advance value
            $balance = 0; // Set balance to 0
        }
        // $receipt_payments = ReceiptPayment::all();

        // $receipts = ReceiptPayment::where('type_id', 1)->get();
        // $payments = ReceiptPayment::where('type_id', 2)->get();

        // $totalReceipts = 0;
        // $totalPayments = 0;

        // foreach ($receipts as $receipt) {
        //     $totalReceipts += $receipt->amount;
        // }

        // foreach ($payments as $payment) {
        //     $totalPayments += $payment->amount;
        // }

        // $balanceReceipt = $totalReceipts - $totalPayments;



        return view('exports.ledger', [
            'data' => $shipments,
            'totalDebit' => $totalDebit,
            'totalCredit' => $totalCredit,
            'balance' => $balance,
            'advance' => $advance
        ]);
    }

    // public function columnFormats(): array
    // {
    //     return [
    //         'F' => NumberFormat::FORMAT_NUMBER,
    //     ];
    // }
}
