<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LogsController;
use App\Models\CustomerSource;
use App\Models\Procedure;
use App\Models\ProductCategories;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CustomerSourceController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, LogsController $logController)
    {

        try {
            $name = $request->name;
            $perPage = $request->input('perPage', session('perPage', 10));
            session(['perPage' => $perPage]);

            $customer_source = CustomerSource::when($name, function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            })->orderBy('created_at', 'desc')
                ->paginate($perPage);
            $logController->createLog(__METHOD__, 'success', 'Viewed Customer Source Index.', auth()->user(), '');

            return view('customerSource.index', compact('customer_source', 'perPage'));
        } catch (Exception $e) {
            dd($e);

            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function add(LogsController $logController)
    {
        try {

            $logController->createLog(__METHOD__, 'success', 'Navigated to Customer Source Add .', auth()->user(), '');

            return view('customerSource.add');
        } catch (Exception $e) {
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function store(Request $request, LogsController $logController)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);

            $customer_source = CustomerSource::create([
                'name' => $request->name,

            ]);
            $logController->createLog(__METHOD__, 'success', 'Customer Source Created.', auth()->user(), '');

            // dd($request->all());

            return redirect()->to('/customer-source')->with('success', 'New Record Created SuccessFully!');
        } catch (Exception $e) {
            // dd($e);
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id, LogsController $logController)
    {
        try {
            $customer_sources = CustomerSource::where('id', $id)->first();
            // dd($customer_sources);

            $logController->createLog(__METHOD__, 'success', 'Navigated to Customer Source Edit .', auth()->user(), '');

            return view('customerSource.edit', compact('customer_sources'));
        } catch (Exception $e) {
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update($id, Request $request, LogsController $logController)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);

            $customer_sources = CustomerSource::where('id', $id)->update([
                'name' => $request->name,
            ]);
            $logController->createLog(__METHOD__, 'success', 'Edited Customer Source', auth()->user(), json_encode($customer_sources));

            return redirect()->to('/customer-source')->with('success', 'Record Updated SuccessFully!');
        } catch (Exception $e) {
            // dd($e);

            $logController->createLog(__METHOD__, 'error', 'Error on Edited Procedure', auth()->user(), json_encode($customer_sources));

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $customer_source = CustomerSource::find($id);
            $customer_source->delete();

            return redirect()->back()->with('success', 'Record Deleted Succesfully!');
        } catch (Exception $e) {

            return redirect()->back()->with('error', '$e');
        }
    }
}
