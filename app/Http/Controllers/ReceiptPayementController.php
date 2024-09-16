<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Charge;
use App\Models\Currencies;
use App\Models\Clients;
use App\Models\CustomerSource;
use App\Models\CustomerTypeMaster;
use App\Models\Patients;
use App\Models\Payments;
use App\Models\Procedure;
use App\Models\ProductCategories;
use App\Models\Products;
use App\Models\Quote;
use App\Models\QuoteDetail;
use App\Models\ReceiptPayment;
use App\Models\Transactions;
use App\Models\TransactionsDetail;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Session;

class ReceiptPayementController extends Controller
{
    public function add()
    {
        // $product_categories = ProductCategories::all();
        // $products = Products::where('status', 1)->get();
        // $customer_types = CustomerTypeMaster::all();
        // $customer_sources = CustomerSource::all();
        // $invoiceNo = Transactions::latest()->first();
        $clients = Clients::where('status', 1)->get();
        $currencies = Currencies::where('status', 1)->get();
        $types = Type::all();

        return view('receipt_payment.add', compact('clients', 'currencies', 'types'));
    }
    public function store(Request $request, LogsController $logController)
    {
        try {

            $receipt_payment = ReceiptPayment::create([
                'client_id' => $request->client_id,
                'type_id' => $request->type_id,
                'account' => $request->account,
                'currency_id' => $request->currency_id,
                'buy' => $request->buy ?? 0,
                'sell' => $request->sell ?? 0,
                'amount' => $request->amount ?? 0,
                'converted_amount' => $request->converted_amount ?? 0,
                'description' => $request->description,
            ]);

            $logController->createLog(__METHOD__, 'success', 'Transactions Created.', auth()->user(), '');

            return redirect()->to('/client-profile/' . $request->client_id . '?section=receipt')->with('success', 'New Record Created SuccessFully!');

            // return redirect()->to('/invoice')->with('success', 'New Record Created SuccessFully!');
        } catch (Exception $e) {
            // dd($e->getMessage());
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(ReceiptPayment $receipt_payment)
    {
        $clients = Clients::where('status', 1)->get();
        $currencies = Currencies::where('status', 1)->get();
        $types = Type::all();

        return view('receipt_payment.edit', compact('receipt_payment', 'clients', 'currencies', 'types'));
    }
    public function update(ReceiptPayment $receipt_payment, Request $request, LogsController $logController)
    {
        // dd($request->all());
        try {
            ReceiptPayment::where('id', $receipt_payment->id)->update([
                'client_id' => $request->client_id,
                'type_id' => $request->type_id,
                'account' => $request->account,
                'currency_id' => $request->currency_id,
                'buy' => $request->buy ?? 0,
                'sell' => $request->sell ?? 0,
                'amount' => $request->amount ?? 0,
                'converted_amount' => $request->converted_amount ?? 0,
                'description' => $request->description,
            ]);

            $logController->createLog(__METHOD__, 'success', 'receipt_payment Updated.', auth()->user(), $receipt_payment);
            return redirect()->to('/client-profile/' . $receipt_payment->client_id . '?section=receipt')->with('success', 'Record Updated SuccessFully!');

            // return redirect()->to('/invoice')->with('success', 'Record Updated SuccessFully!');
        } catch (Exception $e) {
            dd($e);
            $logController->createLog(__METHOD__, 'success', 'Transactions Updated Failed.', auth()->user(), $receipt_payment);

            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
    public function preview($id)
    {
        $transaction = Transactions::where('id', $id)->first();
        if ($transaction) {
            $totalAmountPaid = $transaction->payments->pluck('amount_paid')->sum();
        } else {
            $totalAmountPaid = 0;
        }
        $totalAmountRemaining = $transaction->total_converted_amount - $totalAmountPaid;

        return view('reciept.preview', compact('transaction', 'totalAmountPaid', 'totalAmountRemaining'));
    }
    public function print()
    {
        return view('reciept.print');
    }
    // public function invoicepdf($id)
    // {
    //     $transaction = Transactions::where('id', $id)->first();

    //     $html = view('reciept.pdf', ['transaction' => $transaction])->render();
    //     return PDF::loadHtml($html)->download('reciept.pdf');
    // }
    public function invoicepdf($id)
    {
        $transaction = Transactions::where('id', $id)->first();
        if ($transaction) {
            $totalAmountPaid = $transaction->payments->pluck('amount_paid')->sum();
        } else {
            $totalAmountPaid = 0;
        }
        $totalAmountRemaining = $transaction->total_converted_amount - $totalAmountPaid;
        // dd($transaction);
        $html = view('reciept.pdf', ['transaction' => $transaction, 'totalAmountPaid' => $totalAmountPaid, 'totalAmountRemaining' => $totalAmountRemaining])->render();
        return PDF::loadHtml($html)->download($transaction->customer->name . '-' . Carbon::parse($transaction->date)->format('d-M-Y') . '-' . 'reciept.pdf');
    }
    // $pdf = Pdf::loadview('reciept.pdf', compact('transaction'))->setOptions(['defaultFont' => 'sans-serif']);
    // return $pdf->download('reciept.pdf');

    public function addFromQuote($id)
    {
        $product_categories = ProductCategories::all();
        $products = Charge::where('status', 1)->get();
        $customers = Clients::where('status', 1)->get();
        $currencies = Currencies::where('status', 1)->get();
        $customer_types = CustomerTypeMaster::all();
        $customer_sources = CustomerSource::all();
        $invoiceNo = Transactions::latest()->first();
        // $quote = Quote::findOrFail();
        $quote = Quote::where('id', $id)->first();
        $groupDetails = QuoteDetail::where('quote_id', $quote->id)->get();


        return view('reciept.add_from_quote', compact('product_categories', 'products', 'customers', 'currencies', 'invoiceNo', 'customer_types', 'customer_sources', 'quote', 'groupDetails'));
    }

    public function deleteInvoice($id)
    {
        try {
            $transaction = Transactions::find($id);
            $transaction->delete();

            return redirect()->to('/invoice')->with('success', 'Record Deleted SuccessFully!');
        } catch (Exception $e) {

            return redirect('/invoice')->with('error', $e->getMessage());
        }
    }

    // public function createFromQuote(Request $request, LogsController $logController)
    // {
    //     try {
    //         // Retrieve the quote by its ID
    //         $quote = Quote::findOrFail($request->quote_id);
    //         $groupDetails = QuoteDetail::where('quote_id', $quote->id)->get();
    //         // $groupData = $request->group;
    //         // dd($groupDetails);

    //         $transaction = Transactions::create([
    //             'customer_id' => $quote->customer_id,
    //             'customer_type_id' => $quote->customer_type_id,
    //             'customer_source_id' => $quote->customer_source_id,
    //             'currency_id' => $quote->currency_id,
    //             'conversion_rate' => $quote->conversion_rate,
    //             'sub_total' => $quote->sub_total ?? 0,
    //             'total_discount_percentage' => $quote->total_discount_percentage ?? 0,
    //             'total_discount_amount' => $quote->total_discount_amount ?? 0,
    //             'total_service_charge' => $quote->total_service_charge ?? 0,
    //             'total_service_charge_amount' => $quote->total_service_charge_amount ?? 0,
    //             'total_green_tax_percentage' => $quote->total_green_tax_percentage ?? 0,
    //             'total_green_tax_amount' => $quote->total_green_tax_amount ?? 0,
    //             'total_tax_percentage' => $quote->total_tax_percentage ?? 0,
    //             'total_tax_amount' => $quote->total_tax_amount ?? 0,
    //             // 'card_charges_percentage' => $quote->card_charges_percentage ?? 0,
    //             // 'card_charges_amount' => $quote->card_charges_amount ?? 0,
    //             // 'card_charges_converted_amount' => $quote->card_charges_converted_amount ?? 0,
    //             'total_amount' => $quote->total_amount ?? 0,
    //             'total_converted_amount' => $quote->total_converted_amount ?? $quote->total_amount,
    //             'created_by' => $quote->created_by,
    //             'date' => $quote->date,
    //             'status' => 1,
    //         ]);

    //         $payment = Payments::create([
    //             'transaction_id' => $transaction->id,
    //             'customer_id' => $quote->customer_id,
    //             'amount_paid' => $quote->total_amount,
    //             'payment_mode' => 'cash',
    //             'remaining_amount' => 0,
    //             // $transaction->total_converted_amount - $transaction->paid_amount;
    //             // 'card_charges' => $request->credit_card_input,
    //         ]);

    //         foreach ($groupDetails as $detail) {
    //             $transaction_detail = TransactionsDetail::create([
    //                 'transactions_id' => $transaction->id,
    //                 'product_id' => @$detail['product_id'],
    //                 'product_category_id' => @$detail['product_category_id'],
    //                 // 'persons_rooms' => @$detail['persons_rooms'],
    //                 // 'days_dives' => @$detail['days_dives'],
    //                 // 'quantity' => @$detail['quantity'],
    //                 'charges' => @$detail['charges'],
    //                 // 'tax' => @$detail['tax'],
    //                 // 'discount' => @$detail['discount'],
    //                 'amount' => @$detail['amount'],
    //                 'converted_amount' => @$detail['converted_amount'],
    //                 'status' => 1,
    //             ]);
    //         }

    //         $logController->createLog(__METHOD__, 'success', 'Transactions Created.', auth()->user(), '');


    //         // Flash success message to the session
    //         Session::flash('success', 'Invoice Created Successfully!');

    //         return response()->json(['success' => true]);
    //     } catch (Exception $e) {
    //         // dd($e->getMessage());
    //         $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

    //         return response()->json(['success' => false, 'error' => $e->getMessage()]);
    //     }
    // }

}
