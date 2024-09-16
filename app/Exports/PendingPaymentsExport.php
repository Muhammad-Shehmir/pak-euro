<?php

namespace App\Exports;

use App\Models\Appointment;
use App\Models\Appointments;
use App\Models\Logs;
use App\Models\Transactions;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class PendingPaymentsExport implements FromView, WithCustomStartCell
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public $date_from = null;
    public $date_to = null;

    public function __construct($params)
    {
        $this->date_from = $params['date_from'] ?? null;
        $this->date_to = $params['date_to'] ?? null;
    }

    public function startCell(): string
    {
        return 'A8';
    }

    public function view(): View
    {
        $date_from = $this->date_from;
        $date_to = $this->date_to;

        $res = Transactions::when($date_from, function ($query) use ($date_from) {
            $query->where('created_at', '>=', $date_from);
        })
            ->when($date_to, function ($query) use ($date_to) {
                $query->where('created_at', '<=', $date_to);
            })
            // ->limit(1)
            ->get();

        $res->each(function ($finance) {
            if ($finance->transaction_detail) {
                $procedureNames = $finance->transaction_detail->pluck('procedure.name')->toArray();

                $finance->procedure_names = $procedureNames;
            } else {
                $finance->procedure_names = [];
            }
        });

        $totalAmountSum = $res->sum(function ($finance) {
            return $finance->sum('total_amount') ?? 0;
        });
        $totalDueAmountSum = $res->sum(function ($finance) {
            return $finance->sum('due_amount') ?? 0;
        });
        $totalPaymentAmountSum = $res->sum(function ($finance) {
            return $finance->sum('payment') ?? 0;
        });
        $totalAdvanceAmountSum = $res->sum(function ($finance) {
            return $finance->sum('advance_amount') ?? 0;
        });
        // dd($res[0]);
        return view('exports.pendingPayments', [
            'data' => $res,
            'totalAmountSum' => $totalAmountSum,
            'totalDueAmountSum' => $totalDueAmountSum,
            'totalPaymentAmountSum' => $totalPaymentAmountSum,
            'totalAdvanceAmountSum' => $totalAdvanceAmountSum,
        ]);
    }

    // public function columnFormats(): array
    // {
    //     return [
    //         'F' => NumberFormat::FORMAT_NUMBER,
    //     ];
    // }
}
