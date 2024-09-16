<?php

namespace App\Exports;

use App\Models\Appointment;
use App\Models\Appointments;
use App\Models\Booking;
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
use Carbon\Carbon;


class BookingExport implements FromView, WithCustomStartCell
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public $date_from = null;
    public $date_to = null;

    public function __construct($params)
    {
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

        $res = Booking::when($date_from, function ($query) use ($date_from) {
            $query->where('booking_start', '>=', $date_from);
        })
        ->when($date_to, function ($query) use ($date_to) {
            $query->where('booking_end', '<=', $date_to);
        })->get();

        $totalAmountSum = $res->sum('total_amount') ?? 0;



        return view('exports.booking', [
            'data' => $res,
            'date_from' => $date_from,
            'date_to' => $date_to,
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
