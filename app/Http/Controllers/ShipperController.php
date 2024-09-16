<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\City;
use App\Models\Currencies;
use App\Models\Clients;
use App\Models\Country;
use App\Models\CustomerSource;
use App\Models\CustomerTypeMaster;
use App\Models\Patients;
use App\Models\Payments;
use App\Models\Procedure;
use App\Models\ProductCategories;
use App\Models\Products;
use App\Models\Quote;
use App\Models\QuoteDetail;
use App\Models\Transactions;
use App\Models\TransactionsDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class ShipperController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->input('name');
        $perPage = $request->input('perPage', session('perPage', 10));
        session(['perPage' => $perPage]);

        $shipments = Shipment::when($data, function ($query) use ($data) {
            $query->where('shipper_name', 'like', '%' . $data . '%');
        })->orderby('id', 'desc')->paginate($perPage);

        return view('shipper.index', compact('shipments', 'perPage', 'data'));
    }

    public function add()
    {
        // $product_categories = ProductCategories::all();
        // $products = Products::where('status', 1)->get();
        $clients = Clients::where('status', 1)->where('type_id', 1)->get();
        $vendors = Clients::where('status', 1)->where('type_id', 2)->get();
        $currencies = Currencies::where('status', 1)->get();
        // $customer_types = CustomerTypeMaster::all();
        // $customer_sources = CustomerSource::all();
        // $invoiceNo = Transactions::latest()->first();
        $cities = City::all();
        $countries = Country::all();
        return view('shipper.add', compact('vendors', 'clients', 'cities', 'currencies', 'countries'));
    }


    public function store(Request $request)
    {
        try {
            $shipment = Shipment::create([
                'client_id' => $request->client_id,
                'vendor_id' => $request->vendor_id,
                'date' => $request->date,
                'marks_and_numbers' => $request->marks_and_numbers,
                'bl_no' => $request->bl_no,
                'currency_id' => $request->currency_id ?? 5,
                'buy' => $request->buy ?? 0,
                'sell' => $request->sell ?? 1,
                'rate' => $request->rate ?? 0,
                'carrying_rate' => $request->carrying_rate ?? 0,
                'quantity' => $request->quantity ?? 0,
                'carrying_amount' => $request->carrying_amount ?? 0,
                'converted_carrying_amount' => $request->converted_carrying_amount ?? 0,
                'v_carrying_amount' => $request->v_carrying_amount ?? 0,
                'converted_bill_amount' => $request->converted_bill_amount ?? 0,
                'bill_amount' => $request->bill_amount ?? 0,
                'rcgs_excess' => $request->rcgs_excess ?? 0,
                'vessel_voy' => $request->vessel_voy,
                'bags' => $request->bags,
                'delivery_country_id' => $request->delivery_country_id,
                'delivery_city_id' => $request->delivery_city_id,
                'fcl' => $request->fcl,
                'imcont_no' => $request->imcont_no,
                'expc_no' => $request->expc_no,
                'expc_bags' => $request->expc_bags,
                'loading_date' => $request->loading_date,
                'delivery_date' => $request->delivery_date,
                'eway_bill' => $request->eway_bill,
                'vehicle_and_driver' => $request->vehicle_and_driver,
                'delivery_status' => $request->delivery_status,
                'delivery_address' => $request->delivery_address,
                'delivery_party' => $request->delivery_party,
            ]);

            $latest_transaction = Transactions::where('transaction_type_id' , 1)->latest()->first();

            if ($request->client_id) {
                // Create transaction
                $transaction = Transactions::create([
                    'transaction_type_id' => 1,
                    'client_id' => $request->client_id,
                    'currency_id' => $request->currency_id ?? 5,
                    'tran_no' => 'SHI-' . (int) @$latest_transaction->id + 1 . '/' . date('y'),
                    'date' => Carbon::now()->format('Y-m-d'),
                    'buy' => $request->buy ?? 0,
                    'sell' => $request->sell ?? 1,
                    'amount' => $request->carrying_amount ?? 0,
                    'converted_amount' => $request->converted_carrying_amount ?? 0,
                    'total_amount' => $request->carrying_amount ?? 0,
                    'total_converted_amount' => $request->converted_carrying_amount,
                    'status' => 1,
                    'created_by' => auth()->user()->id,
                ]);

                // Create transaction detail
                $transaction_detail = TransactionsDetail::create([
                    'transactions_id' => $transaction->id,
                    'charge_id' => 1,
                    'description' => 'Invoice Generated By Shipment on: ' . Carbon::now(),
                    'rate' => $request->carrying_rate,
                    'quantity' => $request->quantity,
                    'amount' => $request->carrying_amount ?? 0,
                    'converted_amount' => $request->converted_carrying_amount,
                    'status' => 1,
                ]);
                // Optionally update shipment with invoice number
                $shipment->update([
                    'invoice_no' => $transaction->tran_no,
                ]);
            }
            $latest_vendor_transaction = Transactions::where('transaction_type_id' , 2)->latest()->first();

            if ($request->vendor_id) {
                // Create transaction
                $vendor_transaction = Transactions::create([
                    'transaction_type_id' => 2,
                    'client_id' => $request->vendor_id,
                    'currency_id' => $request->currency_id ?? 5,
                    'tran_no' => 'SHB-' . (int) @$latest_vendor_transaction->id + 1 . '/' . date('y'),
                    'date' => Carbon::now()->format('Y-m-d'),
                    'buy' => $request->buy ?? 0,
                    'sell' => $request->sell ?? 1,
                    'amount' => $request->v_carrying_amount ?? 0,
                    'converted_amount' => $request->converted_bill_amount ?? 0,
                    'total_amount' => $request->v_carrying_amount ?? 0,
                    'total_converted_amount' => $request->converted_bill_amount,
                    'status' => 1,
                    'created_by' => auth()->user()->id,
                ]);

                // Create transaction detail
                $vendor_transaction_detail = TransactionsDetail::create([
                    'transactions_id' => $vendor_transaction->id,
                    'charge_id' => 1,
                    'description' => 'Bill Generated By Shipment on: ' . Carbon::now(),
                    'rate' => $request->rate,
                    'quantity' => $request->quantity,
                    'amount' => $request->v_carrying_amount ?? 0,
                    'converted_amount' => $request->converted_bill_amount,
                    'status' => 1,
                ]);
                $shipment->update([
                    'bill_no' => $vendor_transaction->tran_no,
                ]);
            }

            return redirect()->to('/client-profile/' . $request->client_id)->with('success', 'Shipment added successfully!');
        } catch (Exception $e) {
            dd($e);
            Log::error('Error creating shipment: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('error', 'An error occurred while creating the shipment.');
        }
    }

    public function edit(Shipment $shipment)
    {
        // $products = Products::where('status', 1)->get();
        $clients = Clients::where('status', 1)->where('type_id', 1)->get();
        $vendors = Clients::where('status', 1)->where('type_id', 2)->get();
        $currencies = Currencies::where('status', 1)->get();
        // $customer_sources = CustomerSource::all();
        // $invoiceNo = Transactions::latest()->first();
        $cities = City::all();
        $countries = Country::all();

        return view('shipper.edit', compact('shipment', 'vendors', 'cities', 'countries', 'currencies', 'clients'));
    }

    public function update(Request $request, Shipment $shipment)
    {
        try {

            $shipmentt = Shipment::where('id', $shipment->id)->update([
                'client_id' => $request->client_id,
                'vendor_id' => $request->vendor_id,
                'date' => $request->date,
                'marks_and_numbers' => $request->marks_and_numbers,
                'bl_no' => $request->bl_no,
                'currency_id' => $request->currency_id ?? 5,
                'buy' => $request->buy ?? 0,
                'sell' => $request->sell ?? 1,
                'rate' => $request->rate ?? 0,
                'carrying_rate' => $request->carrying_rate ?? 0,
                'quantity' => $request->quantity ?? 0,
                'carrying_amount' => $request->carrying_amount ?? 0,
                'converted_carrying_amount' => $request->converted_carrying_amount ?? 0,
                'v_carrying_amount' => $request->v_carrying_amount ?? 0,
                'converted_bill_amount' => $request->converted_bill_amount ?? 0,
                'bill_amount' => $request->bill_amount ?? 0,
                'rcgs_excess' => $request->rcgs_excess ?? 0,
                'vessel_voy' => $request->vessel_voy,
                'bags' => $request->bags,
                'delivery_country_id' => $request->delivery_country_id,
                'delivery_city_id' => $request->delivery_city_id,
                'fcl' => $request->fcl,
                'imcont_no' => $request->imcont_no,
                'expc_no' => $request->expc_no,
                'expc_bags' => $request->expc_bags,
                'loading_date' => $request->loading_date,
                'delivery_date' => $request->delivery_date,
                'eway_bill' => $request->eway_bill,
                'vehicle_and_driver' => $request->vehicle_and_driver,
                'delivery_status' => $request->delivery_status,
                'delivery_address' => $request->delivery_address,
                'delivery_party' => $request->delivery_party,
            ]);


            if ($request->client_id) {
                // Create transaction
                $transaction = Transactions::where('id', $shipment->transaction->id)->update([
                    'transaction_type_id' => 1,
                    'client_id' => $request->client_id,
                    'currency_id' => $request->currency_id ?? 5,
                    // 'tran_no' => 'SHI-' . (int) @$latest_transaction->id + 1 . '/' . date('y'),
                    // 'date' => Carbon::now()->format('Y-m-d'),
                    'buy' => $request->buy ?? 0,
                    'sell' => $request->sell ?? 1,
                    'amount' => $request->carrying_amount ?? 0,
                    'converted_amount' => $request->converted_carrying_amount ?? 0,
                    'total_amount' => $request->carrying_amount ?? 0,
                    'total_converted_amount' => $request->converted_carrying_amount,
                    'status' => 1,
                    'created_by' => auth()->user()->id,
                ]);

                // Create transaction detail
                $transaction_detail = TransactionsDetail::where('transactions_id', $shipment->transaction->id)->update([
                    // 'transactions_id' => $transaction->id,
                    'charge_id' => 1,
                    'description' => 'Invoice Generated By Shipment on: ' . Carbon::now(),
                    'rate' => $request->carrying_rate,
                    'quantity' => $request->quantity,
                    'amount' => $request->carrying_amount ?? 0,
                    'converted_amount' => $request->converted_carrying_amount,
                    'status' => 1,
                ]);
            }

            if ($request->vendor_id) {
                // Create transaction
                $vendor_transaction = Transactions::where('id', $shipment->bill->id)->update([
                    'transaction_type_id' => 2,
                    'client_id' => $request->vendor_id,
                    'currency_id' => $request->currency_id ?? 5,
                    // 'tran_no' => 'SHB-' . (int) @$transaction->id + 1 . '/' . date('y'),
                    // 'date' => Carbon::now()->format('Y-m-d'),
                    'buy' => $request->buy ?? 0,
                    'sell' => $request->sell ?? 1,
                    'amount' => $request->v_carrying_amount ?? 0,
                    'converted_amount' => $request->converted_bill_amount ?? 0,
                    'total_amount' => $request->v_carrying_amount ?? 0,
                    'total_converted_amount' => $request->converted_bill_amount,
                    'status' => 1,
                    'created_by' => auth()->user()->id,
                ]);

                // Create transaction detail
                $vendor_transaction_detail = TransactionsDetail::where('transactions_id', $shipment->bill->id)->update([
                    // 'transactions_id' => $vendor_transaction->id,
                    'charge_id' => 1,
                    'description' => 'Bill Generated By Shipment on: ' . Carbon::now(),
                    'rate' => $request->rate,
                    'quantity' => $request->quantity,
                    'amount' => $request->v_carrying_amount ?? 0,
                    'converted_amount' => $request->converted_bill_amount,
                    'status' => 1,
                ]);
            }

            return redirect()->to('/client-profile/' . $shipment->client_id)->with('success', 'Shipment updated successfully!');
        } catch (Exception $e) {
            dd($e);
            Log::error('Error updating shipment: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('error', 'An error occurred while updating the shipment.');
        }
    }

    public function delete($id)
    {
        try {
            $shipment = Shipment::findOrFail($id);
            $shipment->delete();
            return redirect()->back()->with('success', 'Shipment deleted successfully!');
        } catch (Exception $e) {
            Log::error('Error deleting shipment: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('error', 'An error occurred while deleting the shipment.');
        }
    }
}
