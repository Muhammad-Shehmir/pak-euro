<?php

namespace App\Exports;

use App\Models\Appointment;
use App\Models\Appointments;
use App\Models\Logs;
use App\Models\Patients;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class PatientExport implements FromView, WithCustomStartCell
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public $mr_no = null;
    public $date_from = null;
    public $date_to = null;
    public $name = null;
    public $phone_no = null;

    public function __construct($params)
    {
        $this->mr_no = $params['mr_no'] ?? null;
        $this->date_from = $params['date_from'] ?? null;
        $this->date_to = $params['date_to'] ?? null;
        $this->name = $params['name'] ?? null;
        $this->phone_no = $params['phone_no'] ?? null;
    }

    public function startCell(): string
    {
        return 'A8';
    }

    public function view(): View
    {
        $mr_no = $this->mr_no;
        $date_from = $this->date_from;
        $date_to = $this->date_to;
        $name = $this->name;
        $phone_no = $this->phone_no;

        $res = Patients::when($name, function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            })
            ->when($phone_no, function ($query) use ($phone_no) {
                $query->where('phone_no', 'like', '%' . $phone_no . '%');
            })
            ->when($mr_no, function ($query) use ($mr_no) {
                $query->where('mr_number', 'like', '%' . $mr_no . '%');
            })
            ->when($date_from, function ($query) use ($date_from) {
                $query->where('created_at_reference', '>=', $date_from);
            })
            ->when($date_to, function ($query) use ($date_to) {
                $query->where('created_at_reference', '<=', $date_to);
            })
            // ->limit(1)
            ->get();
        // dd($res[0]);
        return view('exports.patient', [
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
