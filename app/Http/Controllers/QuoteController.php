<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Currencies;
use App\Models\Clients;
use App\Models\CustomerSource;
use App\Models\CustomerTypeMaster;
use App\Models\DayMaster;
use App\Models\Patients;
use App\Models\Payments;
use App\Models\Procedure;
use App\Models\ProductCategories;
use App\Models\Products;
use App\Models\Quote;
use App\Models\QuoteDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;

class QuoteController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;
        $perPage = $request->input('perPage', session('perPage', 10));
        session(['perPage' => $perPage]);

        $quotes = Quote::when($name, function ($query) use ($name) {
            $query->whereHas('customer', function ($subQuery) use ($name) {
                $subQuery->where('name', 'like', '%' . $name . '%');
            });
        })->orderby('id', 'desc')->paginate($perPage);

        $customers = Customers::where('status', 1)->get();
        $products = Products::where('status', 1)->get();

        return view('quote.index', compact('quotes', 'perPage', 'customers', 'products'));
    }

    public function add()
    {
        $product_categories = ProductCategories::all();
        $products = Products::where('status', 1)->get();
        $customers = Customers::where('status', 1)->get();
        $currencies = Currencies::where('status', 1)->get();
        $customer_types = CustomerTypeMaster::all();
        $customer_sources = CustomerSource::all();
        $quoteNo = Quote::latest()->first();

        return view('quote.add', compact('product_categories', 'products', 'customers', 'currencies', 'quoteNo', 'customer_types', 'customer_sources'));
    }
    public function store(Request $request, LogsController $logController)
    {
        try {
            // dd($request->all());
            $request->validate([
                'customer_id' => 'required',
                'group' => 'required',
            ]);

            $quote = Quote::create([
                'customer_id' => $request->customer_id,
                'customer_type_id' => $request->customer_type_id,
                'customer_source_id' => $request->customer_source,
                'currency_id' => $request->currency_id,
                'conversion_rate' => $request->conversion_rate,
                'origin' => $request->origin,
                'date' => $request->date,
                'valid_till' => $request->valid_till,
                'pax' => $request->pax,
                'meal_plan' => $request->meal_plan,
                'sub_total' => $request->sub_total ?? 0,
                'total_discount_percentage' => $request->total_discount_percentage ?? 0,
                'total_discount_amount' => $request->total_discount_amount ?? 0,
                'total_service_charge' => $request->total_service_charge ?? 0,
                'total_service_charge_amount' => $request->total_service_charge_amount ?? 0,
                'total_green_tax_percentage' => $request->total_green_tax_percentage ?? 0,
                'total_green_tax_amount' => $request->total_green_tax_amount ?? 0,
                'total_tax_percentage' => $request->total_tax_percentage ?? 0,
                'total_tax_amount' => $request->total_tax_amount ?? 0,
                // 'card_charges_percentage' => $request->card_charges_percentage ?? 0,
                // 'card_charges_amount' => $request->card_charges_amount ?? 0,
                // 'card_charges_converted_amount' => $request->card_charges_converted_amount ?? 0,
                'total_amount' => $request->total_amount ?? 0,
                'total_converted_amount' => $request->total_amount_converted ?? $request->total_amount,
                'created_by' => auth()->user()->id,
                'status' => $request->status,
            ]);

            foreach ($request->group as $detail) {
                $quote_detail = QuoteDetail::create([
                    'quote_id' => $quote->id,
                    'product_id' => @$detail['product_id'],
                    'product_category_id' => @$detail['product_category_id'],
                    'persons_rooms' => @$detail['persons_rooms'],
                    'days_dives' => @$detail['days_dives'],
                    'charges' => @$detail['charges'],
                    // 'tax' => @$detail['tax'],
                    // 'discount' => @$detail['discount'],
                    'amount' => @$detail['amount'],
                    'converted_amount' => @$detail['converted_amount'],
                    'status' => 1,
                ]);
            }

            $logController->createLog(__METHOD__, 'success', 'Quote Created.', auth()->user(), '');

            return redirect()->to('/quote')->with('success', 'New Record Created SuccessFully!');
        } catch (Exception $e) {
            dd($e->getMessage());
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $quote = Quote::where('id', $id)->first();
        $product_categories = ProductCategories::all();
        $products = Products::where('status', 1)->get();
        $customers = Customers::where('status', 1)->get();
        $currencies = Currencies::where('status', 1)->get();
        $customer_types = CustomerTypeMaster::all();
        $customer_sources = CustomerSource::all();

        return view('quote.edit', compact('quote', 'product_categories', 'products', 'customers', 'currencies', 'customer_types', 'customer_sources'));
    }
    public function update(Quote $quote, Request $request, LogsController $logController)
    {
        try {
            Quote::where('id', $quote->id)->update([
                'customer_id' => $request->customer_id,
                'customer_type_id' => $request->customer_type_id,
                'customer_source_id' => $request->customer_source,
                'currency_id' => $request->currency_id,
                'conversion_rate' => $request->conversion_rate,
                'origin' => $request->origin,
                'date' => $request->date,
                'valid_till' => $request->valid_till,
                'pax' => $request->pax,
                'meal_plan' => $request->meal_plan,
                'sub_total' => $request->sub_total ?? 0,
                'total_discount_percentage' => $request->total_discount_percentage ?? 0,
                'total_discount_amount' => $request->total_discount_amount ?? 0,
                'total_service_charge' => $request->total_service_charge ?? 0,
                'total_service_charge_amount' => $request->total_service_charge_amount ?? 0,
                'total_green_tax_percentage' => $request->total_green_tax_percentage ?? 0,
                'total_green_tax_amount' => $request->total_green_tax_amount ?? 0,
                'total_tax_percentage' => $request->total_tax_percentage ?? 0,
                'total_tax_amount' => $request->total_tax_amount ?? 0,
                // 'card_charges_percentage' => $request->card_charges_percentage ?? 0,
                // 'card_charges_amount' => $request->card_charges_amount ?? 0,
                // 'card_charges_converted_amount' => $request->card_charges_converted_amount ?? 0,
                'total_amount' => $request->total_amount ?? 0,
                'total_converted_amount' => $request->total_amount_converted ?? $request->total_amount,
                'created_by' => auth()->user()->id,
                'status' => $request->status,
            ]);

            QuoteDetail::where('quote_id', $quote->id)->delete();
            foreach ($request->group as $detail) {
                $quote_detail = QuoteDetail::create(
                    [
                        'quote_id' => $quote->id,
                        'product_id' => @$detail['product_id'],
                        'product_category_id' => @$detail['product_category_id'],
                        'persons_rooms' => @$detail['persons_rooms'],
                        'days_dives' => @$detail['days_dives'],
                        'charges' => @$detail['charges'],
                        // 'tax' => @$detail['tax'],
                        // 'discount' => @$detail['discount'],
                        'amount' => @$detail['amount'],
                        'converted_amount' => @$detail['converted_amount'],
                        'status' => 1,
                    ]
                );
            }
            $logController->createLog(__METHOD__, 'success', 'Quote Updated.', auth()->user(), $quote);

            return redirect()->to('/quote')->with('success', 'Record Updated SuccessFully!');
        } catch (Exception $e) {
            dd($e);
            $logController->createLog(__METHOD__, 'success', 'Quote Updated Failed.', auth()->user(), $quote);

            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
    public function preview($id)
    {
        $quote = Quote::where('id', $id)->first();

        return view('quote.preview', compact('quote'));
    }
    public function print()
    {
        return view('quote.print');
    }
    // public function quotepdf($id)
    // {
    //     $quote = Quote::where('id', $id)->first();

    //     $html = view('quote.pdf', ['quote' => $quote])->render();
    //     return PDF::loadHtml($html)->download('quote.pdf');
    // }
    public function quotepdf($id)
    {
        $quote = Quote::where('id', $id)->first();

        $html = view('quote.pdf', ['quote' => $quote])->render();
        return PDF::loadHtml($html)->download($quote->customer->name . '-' . Carbon::parse($quote->date)->format('d-M-Y') . '-' . 'quote.pdf');
    }
    public function travelpdf($id)
    {
        try{
            $quote = Quote::where('id', $id)->first();
            $html = view('quote.travelpdf', ['quote' => $quote])->render();
            return PDF::loadHtml($html)->download($quote->customer->name . '-' . Carbon::parse($quote->date)->format('d-M-Y') . '-' . 'travelVoucher.pdf');
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
    // $pdf = Pdf::loadview('quote.pdf', compact('quote'))->setOptions(['defaultFont' => 'sans-serif']);
    // return $pdf->download('quote.pdf');


}
