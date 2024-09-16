<?php

namespace App\Http\Controllers;

use App\Exports\AppointmentExport;
use App\Exports\BookingExport;
use App\Exports\ExpensesExport;
use App\Exports\LedgerExport;
use App\Exports\SecurityLedgerExport;
use App\Exports\PatientExport;
use App\Exports\PendingPaymentsExport;
use App\Exports\ProcedureExport;
use App\Exports\TransactionsExport;
use App\Http\Controllers\LogsController;
use App\Models\Appointment;
use App\Models\ChartOfAccount;
use App\Models\Clients;
use App\Models\Expense;
use App\Models\ExpenseCategories;
use App\Models\Patients;
use App\Models\Procedure;
use App\Models\ReferralHospital;
use App\Models\SecurityDetail;
use App\Models\Shipment;
use App\Models\Transactions;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ledgerReportExport(Request $request, LogsController $logController)
    {
        try {

            $logController->createLog(__METHOD__, 'success', 'Ledger Report Exported.', auth()->user(), '');

            return Excel::download(new LedgerExport($request->all()), 'LedgerReports.xlsx');
        } catch (Exception $e) {

            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function securityLedgerReportExport(Request $request, LogsController $logController)
    {
        try {

            $logController->createLog(__METHOD__, 'success', 'Ledger Report Exported.', auth()->user(), '');

            return Excel::download(new SecurityLedgerExport($request->all()), 'SecurityLedgerReports.xlsx');
        } catch (Exception $e) {

            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function ledgerIndex(Request $request, LogsController $logController)
    {
        try {
            $clients = Clients::where('status', 1)->where('type_id', 1)->get();
            $vendors = Clients::where('status', 1)->where('type_id', 2)->get();

            $shipments = Shipment::query()
                ->when(request('client_id'), function ($query) {
                    return $query->whereIn('client_id', request('client_id'));
                })
                ->when(request('date_from') && request('date_to'), function ($query) {
                    $startOfDay = Carbon::parse(request('date_from'))->startOfDay();
                    $endOfDay = Carbon::parse(request('date_to'))->endOfDay();
                    return $query->whereBetween('created_at', [$startOfDay, $endOfDay]);
                })
                ->orderby('invoice_no', 'DESC')
                ->get();

            $logController->createLog(__METHOD__, 'success', 'Transactions Report Index.', auth()->user(), '');

            return view('reports.ledgers', compact('shipments', 'clients', 'vendors'));
            // , compact('finances', 'perPage'));
        } catch (Exception $e) {
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
   
    public function vendorLedgerIndex(Request $request, LogsController $logController)
    {
        try {
            $clients = Clients::where('status', 1)->where('type_id', 1)->get();
            $vendors = Clients::where('status', 1)->where('type_id', 2)->get();

            $shipments = Shipment::query()
                ->when(request('vendor_id'), function ($query) {
                    return $query->whereIn('vendor_id', request('vendor_id'));
                })
                ->when(request('date_from') && request('date_to'), function ($query) {
                    $startOfDay = Carbon::parse(request('date_from'))->startOfDay();
                    $endOfDay = Carbon::parse(request('date_to'))->endOfDay();
                    return $query->whereBetween('created_at', [$startOfDay, $endOfDay]);
                })
                ->orderby('invoice_no', 'DESC')
                ->get();

            $logController->createLog(__METHOD__, 'success', 'Transactions Report Index.', auth()->user(), '');

            return view('reports.vendor_ledgers', compact('shipments', 'clients', 'vendors'));
            // , compact('finances', 'perPage'));
        } catch (Exception $e) {
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    public function financesReportExport(Request $request, LogsController $logController)
    {
        try {

            $logController->createLog(__METHOD__, 'success', 'Transactions Report Exported.', auth()->user(), '');

            return Excel::download(new TransactionsExport($request->all()), 'FinancesReports.xlsx');
        } catch (Exception $e) {

            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function SecurityIndex(Request $request, LogsController $logController)
    {
        try {
            $clients = Clients::where('status', 1)->where('type_id', 1)->get();
            $vendors = Clients::where('status', 1)->where('type_id', 2)->get();

            $security_details = SecurityDetail::query()
                ->when(request('client_id'), function ($query) {
                    return $query->whereIn('client_id', request('client_id'));
                })
                ->when(request('vendor_id'), function ($query) {
                    return $query->whereIn('vendor_id', request('vendor_id'));
                })
                ->when(request('date_from') && request('date_to'), function ($query) {
                    $startOfDay = Carbon::parse(request('date_from'))->startOfDay();
                    $endOfDay = Carbon::parse(request('date_to'))->endOfDay();
                    return $query->whereBetween('created_at', [$startOfDay, $endOfDay]);
                })->orderBy('created_at', 'desc')->get();

            $totalSecurityAmount = 0;

            foreach ($security_details as $security_detail) {
                if ($security_detail->type_id == 1) {
                    $totalSecurityAmount += $security_detail->amount;
                }
                if ($security_detail->type_id == 2) {
                    $totalSecurityAmount -= $security_detail->amount;
                }
            }

            $logController->createLog(__METHOD__, 'success', 'Navigated to Expenses Report Index.', auth()->user(), '');

            return view('reports.security_ledgers', compact('security_details', 'totalSecurityAmount','clients','vendors'));
        } catch (Exception $e) {
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function expensesReportExport(Request $request, LogsController $logController)
    {
        try {

            $logController->createLog(__METHOD__, 'success', 'Expenses Report Exported.', auth()->user(), '');

            return Excel::download(new ExpensesExport($request->all()), 'ExpensesReports.xlsx');
        } catch (Exception $e) {

            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
