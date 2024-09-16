<?php

namespace App\Exports;

use App\Models\Appointment;
use App\Models\Appointments;
use App\Models\Expense;
use App\Models\Logs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ExpensesExport implements FromView, WithCustomStartCell
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public $date_from = null;
    public $date_to = null;
    public $chart_of_account = null;
    public $expenseCategory = null;

    public function __construct($params)
    {
        $this->date_from = $params['date_from'] ?? null;
        $this->date_to = $params['date_to'] ?? null;
        $this->chart_of_account = $params['chart_of_account'] ?? null;
        $this->expenseCategory = $params['expenseCategory'] ?? null;
    }

    public function startCell(): string
    {
        return 'A8';
    }

    public function view(): View
    {
        $date_from = $this->date_from;
        $date_to = $this->date_to;
        $chart_of_account = $this->chart_of_account;
        $expenseCategory = $this->expenseCategory;

        $res = Expense::when($chart_of_account, function ($query) use ($chart_of_account) {
            $query->whereHas('chart_of_account', function ($subQuery) use ($chart_of_account) {
                $subQuery->where('id', 'like', '%' . $chart_of_account . '%');
            });
        })->when($expenseCategory, function ($query) use ($expenseCategory) {
            $query->whereHas('expense_categories', function ($subQuery) use ($expenseCategory) {
                $subQuery->where('id', 'like', '%' . $expenseCategory . '%');
            });
        })
            ->when($date_from, function ($query) use ($date_from) {
                $query->where('created_at', '>=', $date_from);
            })
            ->when($date_to, function ($query) use ($date_to) {
                $query->where('created_at', '<=', $date_to);
            })
            // ->limit(1)
            ->get();

        $totalAmountSum = $res->sum(function ($expense) {
            return $expense->sum('amount') ?? 0;
        });
        // dd($res[0]);
        return view('exports.expenses', [
            'data' => $res,
            'totalAmountSum' => $totalAmountSum
        ]);
    }

    // public function columnFormats(): array
    // {
    //     return [
    //         'F' => NumberFormat::FORMAT_NUMBER,
    //     ];
    // }
}
