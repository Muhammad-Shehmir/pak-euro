<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Clients;
use App\Models\ReceiptPayment;
use App\Models\DayMaster;
use App\Models\Patients;
use App\Models\Payments;
use App\Models\Procedure;
use App\Models\Charge;
use App\Models\Shipment;
use App\Models\Transactions;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Exception;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(LogsController $logController)
    {
         try {
            $clientsCount = Clients::count();
            $shipmentCount = Shipment::count();
            $invoicesCount = Transactions::count();
            $receiptsCount = ReceiptPayment::count();
            // $productsCount = Products::where('product_category_id', 1)->count();

    //         $payments = Payments::whereDate('created_at', now()->toDateString())->get();

    //         $financial_summary = $payments->sum(function ($payment) {
    //             switch ($payment->currency_id) {
    //                 case 1:
    //                     return $payment->amount_paid / 15.40;
    //                 case 2:
    //                     return $payment->amount_paid * 0.91;
    //                 default:
    //                     return $payment->amount_paid;
    //             }
    //         });

    //         $recent_bookings = Booking::whereDate('booking_start', Carbon::now()->startOfDay())
    //             ->with(['customer', 'product'])
    //             ->get();

    //         $booking_count = Booking::count();

    //         $startOfWeek = Carbon::now()->startOfWeek();
    //         $endOfWeek = Carbon::now()->endOfWeek();

    // //         // Initialize totals
    //         $total_amount_received = 0;
    //         $sum_total_amount = 0;

    // //         // Fetch transactions and convert based on currency
    //         $transactions = Transactions::with('payments', 'currency')
    //             ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
    //             ->get();

    //         foreach ($transactions as $detail) {

    //             foreach ($detail->payments as $transaction) {
    //                 // Convert payment amount based on currency
    //                 if ($detail->currency_id == 1) {
    //                     $converted_payment = $transaction->amount_paid / 15.40;
    //                 } elseif ($detail->currency_id == 2) {
    //                     $converted_payment = $transaction->amount_paid * 0.91;
    //                 } else {
    //                     $converted_payment = $transaction->amount_paid;
    //                 }
    //                 $total_amount_received += $converted_payment;
    //             }
    //         }
    // //         // dd($total_amount_received);

    // //         // Calculate weekly transactions and amounts for the chart
    //         $weekly_transactions = Payments::whereBetween('created_at', [$startOfWeek, $endOfWeek])
    //             ->pluck('amount_paid')->map(function ($amount) {
    //                 return (int) str_replace(',', '', $amount);
    //             });
    //         // dd($weekly_transactions);
    //         // Define currency conversion rates
    //         $mvr_to_usd = 15.40;
    //         $euro_to_usd = 0.91;

    // //         // Calculate weekly transactions and amounts for the chart
    //         $weekly_transactions = Payments::whereBetween('created_at', [$startOfWeek, $endOfWeek])
    //             ->get(['amount_paid', 'currency_id']) // Get both amount_paid and currency_id
    //             ->map(function ($transaction) use ($mvr_to_usd, $euro_to_usd) {
    //                 $amount = (int) str_replace(',', '', $transaction->amount_paid);
    //                 $currency_id = $transaction->currency_id;

    //                 if ($currency_id == 1) {
    //                     return $amount / $mvr_to_usd;
    //                 } elseif ($currency_id == 2) {
    //                     return $amount * $euro_to_usd;
    //                 } else {
    //                     return $amount; // No conversion needed for USD
    //                 }
    //             });

    //         $weekly_amount_transactions = Transactions::whereBetween('created_at', [$startOfWeek, $endOfWeek])
    //             ->pluck('total_amount')->map(function ($amount) {
    //                 return (int) str_replace(',', '', $amount);
    //             });

    //         $minValue = (int) $weekly_transactions->min();
    //         $maxValue = (int) $weekly_transactions->max();

            $logController->createLog(__METHOD__, 'success', 'Navigated to Dashboard.', auth()->user(), '');

            return view(
                'dashboard',
                compact(
                    'clientsCount',
                    'invoicesCount',
                    'shipmentCount',
                    'receiptsCount'
                    // 'minValue',
                    // 'maxValue',
                    // 'weekly_amount_transactions',
                    // 'recent_bookings',
                    // 'booking_count',
                    // 'total_amount_received'
                )
            );
        } catch (Exception $e) {
            dd($e);
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
