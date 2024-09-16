<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Currencies;
use App\Models\Clients;
use App\Models\CustomerSource;
use App\Models\CustomerTypeMaster;
use App\Models\Patients;
use App\Models\Payments;
use App\Models\Procedure;
use App\Models\ProductCategories;
use App\Models\Charge;
use App\Models\Charges;
use App\Models\Quote;
use App\Models\QuoteDetail;
use App\Models\Transactions;
use App\Models\TransactionsDetail;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Session;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;
        $perPage = $request->input('perPage', session('perPage', 10));
        session(['perPage' => $perPage]);

        $transactions = Transactions::when($name, function ($query) use ($name) {
            $query->whereHas('clients', function ($subQuery) use ($name) {
                $subQuery->where('name', 'like', '%' . $name . '%');
            });
        })->orderby('id', 'desc')->paginate($perPage);

        foreach ($transactions as $transaction) {
            $transaction->paid_amount = $transaction->payments->pluck('amount_paid')->sum();
            $transaction->remaining_amount = $transaction->total_converted_amount - $transaction->paid_amount;
        }
        // dd($transaction->total_converted_amount);

        return view('invoice.index', compact('transactions', 'perPage'));
    }

    public function add()
    {
        // $product_categories = ProductCategories::all();
        $charges = Charge::where('status', 1)->get();
        $clients = Clients::where('status', 1)->get();
        $currencies = Currencies::where('status', 1)->get();
        // $customer_sources = CustomerSource::all();
        // $invoiceNo = Transactions::latest()->first();

        return view('invoice.add', compact('charges', 'clients', 'currencies'));
    }

    // SQLSTATE[42S22]: Column not found: 1054 Unknown column 'persons_rooms' in 'field list' (Connection: mysql, SQL: insert into `transactions_detail` (`transactions_id`, `charge_id`, `product_category_id`, `persons_rooms`, `days_dives`, `charges`, `tax`, `discount`, `amount`, `converted_amount`, `status`, `updated_at`, `created_at`) values (22, ?, ?, ?, ?, ?, ?, ?, 2050.00, 102500.00, 1, 2024-08-20 09:17:


    public function store(Request $request, LogsController $logController)
    {
        try {
            // $request->validate([
            //     'client_id' => 'required',
            //     'group' => 'required',
            // ]);

            $latest_transaction = Transactions::latest()->first();

            $transaction = Transactions::create([
                'client_id' => $request->client_id,
                'currency_id' => $request->currency_id,
                'tran_no' => 'SH-' . (int) @$latest_transaction->id + 1 . '/' . date('y'),
                'date' => Carbon::now()->format('Y-m-d'),
                'buy' => $request->buy ?? 0,
                'sell' => $request->sell ?? 0,
                'amount' => $request->sub_total ?? 0,
                'converted_amount' => $request->total_amount_converted ?? 0,
                'total_discount_percentage' => $request->total_discount_percentage ?? 0,
                'total_discount_amount' => $request->total_discount_amount ?? 0,
                'total_tax_percentage' => $request->total_tax_percentage ?? 0,
                'total_tax_amount' => $request->total_tax_amount ?? 0,
                'total_amount' => $request->total_amount ?? 0,
                'total_converted_amount' => $request->total_amount_converted ?? 0,
                'created_by' => auth()->user()->id,
                'status' => 1,
            ]);

            // $payment = Payments::create([
            //     'currency_id' => $request->currency_id,
            //     'transaction_id' => $transaction->id,
            //     'client_id' => $request->client_id,
            //     'amount_paid' => $request->payment,
            //     'payment_mode' => $request->payment_mode,
            //     'remaining_amount' => $request->due_amount,
            //     'card_charges' => $request->credit_card_input,
            //     'status' => 1,
            // ]);



            foreach ($request->group as $detail) {
                $transaction_detail = TransactionsDetail::create([
                    'transactions_id' => $transaction->id,
                    'charge_id' => @$detail['charge_id'],
                    'rate' => @$detail['rate'],
                    'quantity' => @$detail['quantity'],
                    'description' => @$detail['description'],
                    // 'tax' => @$detail['tax'],
                    // 'discount' => @$detail['discount'],
                    'amount' => @$detail['amount'],
                    'converted_amount' => @$detail['converted_amount'],
                    'status' => 1,
                ]);
            }

            $logController->createLog(__METHOD__, 'success', 'Transactions Created.', auth()->user(), '');

            return redirect()->to('/client-profile/' . $request->client_id . '?section=finances')->with('success', 'New Record Created SuccessFully!');
        } catch (Exception $e) {
            // dd($e->getMessage());
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $transaction = Transactions::with('payments')->where('id', $id)->first();
        // $product_categories = ProductCategories::all();
        $charges = Charge::where('status', 1)->get();
        $clients = Clients::where('status', 1)->get();
        $types = Type::all();
        $currencies = Currencies::where('status', 1)->get();

        $transaction_details = TransactionsDetail::where('transactions_id', $transaction->id)->get();

        if ($transaction) {
            $totalAmountPaid = $transaction->payments->pluck('amount_paid')->sum();
        } else {
            $totalAmountPaid = 0;
        }

        $difference = $transaction->total_amount - $totalAmountPaid;

        if ($difference >= 0) {
            $totalAmountRemaining = $difference;
            $advanceAmount = 0;
        } else {
            $totalAmountRemaining = 0;
            $advanceAmount = abs($difference); // Convert to positive
        }

        return view('invoice.edit', compact('transaction', 'transaction_details', 'types', 'charges', 'clients', 'currencies', 'totalAmountRemaining', 'totalAmountPaid', 'advanceAmount'));
    }
    public function update(Transactions $transaction, Request $request, LogsController $logController)
    {
        // dd($request->all());
        try {

            Transactions::where('id', $transaction->id)->update([
                'client_id' => $request->client_id,
                'currency_id' => $request->currency_id,
                'buy' => $request->buy ?? 0,
                'sell' => $request->sell ?? 0,
                'amount' => $request->sub_total ?? 0,
                'converted_amount' => $request->total_amount_converted ?? 0,
                'total_discount_percentage' => $request->total_discount_percentage ?? 0,
                'total_discount_amount' => $request->total_discount_amount ?? 0,
                'total_tax_percentage' => $request->total_tax_percentage ?? 0,
                'total_tax_amount' => $request->total_tax_amount ?? 0,
                'total_amount' => $request->total_amount ?? 0,
                'total_converted_amount' => $request->total_amount_converted ?? 0,
                'status' => 1,
            ]);

            TransactionsDetail::where('transactions_id', $transaction->id)->delete();
            if ($request->type_id == 1) {
                if ($request->payment) {
                    $payment = Payments::create([
                        'currency_id' => $request->currency_id,
                        'transaction_id' => $transaction->id,
                        'amount_paid' => $request->payment,
                        'remaining_amount' => $request->due_amount,
                        'advance_amount' => $request->advance_amount,
                        'client_id' => $request->client_id,
                        'status' => 1,
                    ]);
                }
            }
            if ($request->type_id == 2) {
                if ($request->payment) {
                    $payment = Payments::create([
                        'currency_id' => $request->currency_id,
                        'transaction_id' => $transaction->id,
                        'amount_paid' => -$request->payment,
                        'remaining_amount' => $request->due_amount,
                        'advance_amount' => $request->advance_amount,
                        'client_id' => $request->client_id,
                        'status' => 1,
                    ]);
                }
            }
            foreach ($request->group as $detail) {
                $transaction_detail = TransactionsDetail::create([
                    'transactions_id' => $transaction->id,
                    'charge_id' => @$detail['charge_id'],
                    'rate' => @$detail['rate'],
                    'quantity' => @$detail['quantity'],
                    'description' => @$detail['description'],
                    // 'tax' => @$detail['tax'],
                    // 'discount' => @$detail['discount'],
                    'amount' => @$detail['amount'],
                    'converted_amount' => @$detail['converted_amount'],
                    'status' => 1,
                ]);
            }
            $logController->createLog(__METHOD__, 'success', 'Transactions Updated.', auth()->user(), $transaction);

            return redirect()->to('/client-profile/' . $request->client_id . '?section=finances')->with('success', 'Record Updated SuccessFully!');
        } catch (Exception $e) {
            dd($e);
            $logController->createLog(__METHOD__, 'success', 'Transactions Updated Failed.', auth()->user(), $transaction);

            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
    public function preview($id)
    {
        $transaction = Transactions::where('id', $id)->first();
        $charge = Charge::where('id', $id)->first();

        return view('invoice.preview', compact('transaction', 'charge'));
    }
    public function print()
    {
        return view('invoice.print');
    }
    // public function invoicepdf($id)
    // {
    //     $transaction = Transactions::where('id', $id)->first();

    //     $html = view('invoice.pdf', ['transaction' => $transaction])->render();
    //     return PDF::loadHtml($html)->download('invoice.pdf');
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
        $html = view('invoice.pdf', ['transaction' => $transaction, 'totalAmountPaid' => $totalAmountPaid, 'totalAmountRemaining' => $totalAmountRemaining])->render();
        return PDF::loadHtml($html)->download($transaction->clients->name . '-' . Carbon::parse($transaction->date)->format('d-M-Y') . '-' . 'invoice.pdf');
    }
    // $pdf = Pdf::loadview('invoice.pdf', compact('transaction'))->setOptions(['defaultFont' => 'sans-serif']);
    // return $pdf->download('invoice.pdf');

    public function addFromQuote($id)
    {
        $product_categories = ProductCategories::all();
        $charges = Charge::where('status', 1)->get();
        $client = Clients::where('status', 1)->get();
        $currencies = Currencies::where('status', 1)->get();
        $customer_types = CustomerTypeMaster::all();
        $customer_sources = CustomerSource::all();
        $invoiceNo = Transactions::latest()->first();
        // $quote = Quote::findOrFail();
        $quote = Quote::where('id', $id)->first();
        $groupDetails = QuoteDetail::where('quote_id', $quote->id)->get();


        return view('invoice.add_from_quote', compact('product_categories', 'charges', 'customers', 'currencies', 'invoiceNo', 'customer_types', 'customer_sources', 'quote', 'groupDetails'));
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
