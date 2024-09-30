<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Booking;
use App\Models\CustomerArrivalDeparture;
use App\Models\CustomerDocument;
use App\Models\CustomerDocumentImage;
use App\Models\CustomerFamily;
use App\Models\Clients;
use App\Models\DentalDiseases;
use App\Models\DentalQuadrant;
use App\Models\DentalQuadrantDetail;
use App\Models\Diseases;
use App\Models\LabReports;
use App\Models\MedicalDiseases;
use App\Models\MedicalReports;
use App\Models\Notes;
use App\Models\ReceiptPayment;
use App\Models\PatientMedicalHistory;
use App\Models\Shipment;
use App\Models\Patients;
use App\Models\Payments;
use App\Models\Procedure;
use App\Models\RelationshipMaster;
use App\Models\SecurityDetail;
use App\Models\Transactions;
use App\Models\TreatmentPlans;
use App\Models\User;
use Exception;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CustomersProfileController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, Clients $customer, LogsController $logController)
    {
        try {
            $customer = Clients::where('id', $customer->id)->first();

            $shipments = Shipment::where('client_id', $customer->id)->orWhere('vendor_id', $customer->id)->orderby('invoice_no', 'DESC')->get();
            //  dd($shipments);
            
            $transactions = Transactions::where('client_id', $customer->id)->orderby('id', 'DESC')->get();
            // dd($transactions);
            $total_amount_recieved = 0;
            $sum_total_amount = 0;

            foreach ($transactions as $detail) {
                $sum_total_amount += $detail->total_amount;

                foreach ($detail->payments as $transaction) {
                    $total_amount_recieved += $transaction->amount_paid;
                }
            }

            $balance = $sum_total_amount - $total_amount_recieved;
            // dd(-$balance);

            // $receipt_payments = ReceiptPayment::all();
            $receipt_payments = ReceiptPayment::orderBy('created_at', 'desc')->get();
            $security_details = SecurityDetail::where('client_id', $customer->id)->orderBy('created_at', 'desc')->get();

            $receipts = ReceiptPayment::where('type_id', 1)->get();
            $payments = ReceiptPayment::where('type_id', 2)->get();

            $totalSecurityAmount = 0;
            $totalReceipts = 0;
            $totalPayments = 0;

            foreach ($receipts as $receipt) {
                $totalReceipts += $receipt->amount;
            }

            foreach ($security_details as $security_detail) {
                if ($security_detail->type_id == 1) {
                    $totalSecurityAmount += $security_detail->amount;
                }
                if ($security_detail->type_id == 2) {
                    $totalSecurityAmount -= $security_detail->amount;
                }
            }
            foreach ($payments as $payment) {
                $totalPayments += $payment->amount;
            }

            $balanceReceipt = $totalReceipts - $totalPayments;

            // $logController->createLog(__METHOD__, 'success', 'Navigated to Customer Profile.', auth()->user(), '');

            return view('patient_profile.index', compact( 'customer', 'security_details', 'totalSecurityAmount', 'totalReceipts', 'totalPayments', 'balanceReceipt', 'receipt_payments',  'transactions', 'total_amount_recieved', 'balance', 'shipments'));
        } catch (Exception $e) {
            // dd($e);
            // $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function pdf($id)
    {
        // Increase the maximum execution time to 5 minutes
        // ini_set('max_execution_time', 300); // 300 seconds = 5 minutes

        $client = Clients::where('id', $id)->first();
        $shipments = Shipment::where('client_id', $id)->orWhere('vendor_id', $id)->orderby('id', 'DESC')->get();
        $transactions = Transactions::with('payments')->where('client_id', $id)->orderby('id', 'DESC')->get();

        $total_amount_recieved = 0;
        $sum_total_amount = 0;

        foreach ($transactions as $detail) {
            $sum_total_amount += $detail->total_amount;
            foreach ($detail->payments as $transaction) {
                $total_amount_recieved += $transaction->amount_paid;
            }
        }

        $balance = $sum_total_amount - $total_amount_recieved;

        return view('client.client_ledger', [
            'shipments' => $shipments,
            'client' => $client,
            'sum_total_amount' => $sum_total_amount,
            'total_amount_recieved' => $total_amount_recieved,
            'transactions' => $transactions,
            'balance' => $balance
        ]);

        // return PDF::loadHtml($html)->download($client->name . '-' . Carbon::now()->format('d-M-Y') . '-' . 'invoice.pdf');
    }


    public function secLedgerPdf($id)
    {
        $client = Clients::where('id', $id)->first();
        $security_details = SecurityDetail::where('client_id', $id)->orderBy('created_at', 'desc')->get();

        $totalSecurityAmount = 0;

        foreach ($security_details as $security_detail) {
            if ($security_detail->type_id == 1) {
                $totalSecurityAmount += $security_detail->amount;
            }
            if ($security_detail->type_id == 2) {
                $totalSecurityAmount -= $security_detail->amount;
            }
        }

        return view('client.sec_ledger', ['security_details' => $security_details, 'client' => $client, 'totalSecurityAmount' => $totalSecurityAmount]);
    }
}
