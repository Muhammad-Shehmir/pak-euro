<?php

namespace App\Exports;

use App\Models\Appointment;
use App\Models\Appointments;
use App\Models\Logs;
use App\Models\Procedure;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ProcedureExport implements FromView, WithCustomStartCell
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public $date_from = null;
    public $date_to = null;
    public $name = null;

    public function __construct($params)
    {
        $this->date_from = $params['date_from'] ?? null;
        $this->date_to = $params['date_to'] ?? null;
        $this->name = $params['name'] ?? null;
    }

    public function startCell(): string
    {
        return 'A8';
    }

    public function view(): View
    {
        $date_from = $this->date_from;
        $date_to = $this->date_to;
        $name = $this->name;

        $res = Procedure::with('doctor')->when($name, function ($query) use ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        })->when($date_from, function ($query) use ($date_from) {
            $query->where('created_at', '>=', $date_from);
        })->when($date_to, function ($query) use ($date_to) {
            $query->where('created_at', '<=', $date_to);
        })
            // ->limit(1)
            ->get();
        // dd($res[0]);
        return view('exports.procedure', [
            'data' => $res
        ]);
    }

    // public function columnFormats(): array
    // {
    //     return [
    //         'F' => NumberFormat::FORMAT_NUMBER,
    //     ];
    // }
}
