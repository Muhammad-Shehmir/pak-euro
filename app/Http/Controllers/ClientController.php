<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\LogsController;
use App\Models\Clients;
use App\Models\City;
use App\Models\ClientTypes;
use App\Models\Country;

class ClientController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, LogsController $logController)
    {
        try {
            $name = $request->client_id;
            $phone_no = $request->phone_no;
            $perPage = $request->input('perPage', session('perPage', 10));
            session(['perPage' => $perPage]);

            $all_clients = Clients::all();
            $clients = Clients::when($name, function ($query) use ($name) {
                $query->where('id', (int) $name);
            })->when($phone_no, function ($query) use ($phone_no) {
                $query->where('phone_no', 'like', '%' . $phone_no . '%');
            })->orderBy('created_at', 'desc')
                ->paginate($perPage);

            $logController->createLog(__METHOD__, 'success', 'Navigated to Client Index.', auth()->user(), '');

            return view('client.index', compact('clients', 'all_clients', 'perPage'));
        } catch (Exception $e) {
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    public function add()
    {
        $cities = City::all();
        $types = ClientTypes::all();
        $countries = Country::all();
        return view('client.add', compact('types', 'cities', 'countries'));
    }

    public function store(Request $request, LogsController $logController)
    {

        try {

            $request->validate([
                'name' => 'required',
                'father_name' => 'nullable',
                'email' => 'nullable',
                'phone_no' => 'nullable',
                'whatsapp_no' => 'nullable',
            ]);

            $client = Clients::create([
                'type_id' => $request->type_id,
                'name' => $request->name,
                'father_name' => $request->father_name,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'whatsapp_no' => $request->whatsapp_no,
                'address' => $request->address,
                'city_id' => $request->city_id,
                'country_id' => $request->country_id,
                'status' => 1,
            ]);

            $logController->createLog(__METHOD__, 'success', 'Client Created.', auth()->user(), '');

            return redirect()->to('/client')->with('success', 'New Record Created SuccessFully!');
        } catch (Exception $e) {
            dd($e);
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Clients $client)
    {
        // $customer = Clients::where('id', $client->id)->first();
        // $customer_types = CustomerTypeMaster::all();
        $cities = City::all();
        $countries = Country::all();
        $types = ClientTypes::all();

        return view('client.edit', compact('types', 'client', 'cities', 'countries'));
    }

    public function update(Clients $client, Request $request, LogsController $logController)
    {
        try {
            $request->validate([
                'name' => 'required',
                'father_name' => 'nullable',
                'email' => 'nullable',
                'phone_no' => 'nullable',
            ]);

            Clients::where('id', $client->id)->update([
                'type_id' => $request->type_id,
                'name' => $request->name,
                'father_name' => $request->father_name,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'address' => $request->address,
                'city_id' => $request->city_id,
                'country_id' => $request->country_id,
                'whatsapp_no' => $request->whatsapp_no,
                'status' => 1,
            ]);



            $logController->createLog(__METHOD__, 'success', 'Edited Client', auth()->user(), json_encode($client));

            return redirect()->to('/client')->with('success', 'Record Updated SuccessFully!');
        } catch (Exception $e) {
            // dd($e);
            $logController->createLog(__METHOD__, 'error', 'Error on Edited client', auth()->user(), json_encode($client));

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $client = Clients::find($id);
            $client->delete();

            return redirect()->back()->with('success', 'Record Deleted Succesfully!');
        } catch (Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
