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
use Carbon\Carbon;

class TransactionsExport implements FromView, WithCustomStartCell
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public $date_from = null;
    public $date_to = null;

    public function __construct($params)
    {
        // $this->date_from = $params['date_from'] ?? Carbon::now()->startOfMonth()->toDateString();
        // $this->date_to = $params['date_to'] ?? Carbon::now()->toDateString();
        $this->date_from = isset($params['date_from']) ? Carbon::parse($params['date_from'])->startOfDay()->format('Y-m-d') : Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->date_to = isset($params['date_to']) ? Carbon::parse($params['date_to'])->endOfDay()->format('Y-m-d') : Carbon::now()->format('Y-m-d');
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
            $query->where('date', '>=', $date_from);
        })
        ->when($date_to, function ($query) use ($date_to) {
            $query->where('date', '<=', $date_to);
        })
        // ->limit(1)
        ->get();

        // dd($res);

        $res->each(function ($finance) {
            if ($finance->transaction_detail) {
                $productNames = $finance->transaction_detail->pluck('product.name')->toArray();

                $finance->product_names = $productNames;
            } else {
                $finance->product_names = [];
            }
        });

        $grossAmountSum = $res->sum('sub_total') ?? 0;
        $totalGreenTaxSum = $res->sum('total_green_tax_amount') ?? 0;
        $totaltaxSum = $res->sum('total_tax_amount') ?? 0;
        $totalServiceChargeSum = $res->sum('total_service_charge_amount') ?? 0;
        $totalCardChargesSum = $res->sum('card_charges_amount') ?? 0;
        $totalAmountSum = $res->sum('total_amount') ?? 0;

        return view('exports.transactions', [
            'data' => $res,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'grossAmountSum' => $grossAmountSum,
            'totalGreenTaxSum' => $totalGreenTaxSum,
            'totaltaxSum' => $totaltaxSum,
            'totalServiceChargeSum' => $totalServiceChargeSum,
            'totalCardChargesSum' => $totalCardChargesSum,
            'totalAmountSum' => $totalAmountSum,
        ]);
    }

    // public function columnFormats(): array
    // {
    //     return [
    //         'F' => NumberFormat::FORMAT_NUMBER,
    //     ];
    // }
}

