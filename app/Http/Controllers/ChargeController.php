<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LogsController;
use App\Models\Procedure;
use App\Models\ProductCategories;
use App\Models\Charge;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ChargeController extends BaseController
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

            // $product_categories = ProductCategories::all();

            $charges = Charge::when($name, function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            })->orderBy('created_at', 'desc')
                ->paginate($perPage);
            $logController->createLog(__METHOD__, 'success', 'Viewed Charges Index.', auth()->user(), '');

            return view('charge.index', compact('charges', 'perPage'));
        } catch (Exception $e) {
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function add(LogsController $logController)
    {
        try {

            // $product_categories = ProductCategories::all();

            $logController->createLog(__METHOD__, 'success', 'Navigated to Products Add .', auth()->user(), '');

            return view('charge.add');
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
                'price' => 'required',
            ]);

            $charge = Charge::create([
                'name' => $request->name,
                'price' => $request->price,
                'status' => 1,

            ]);
            $logController->createLog(__METHOD__, 'success', 'Charge Created.', auth()->user(), '');

            // dd($request->all());

            return redirect()->to('/charges')->with('success', 'New Record Created SuccessFully!');
        } catch (Exception $e) {
            // dd($e);
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Charge $charge, LogsController $logController)
    {
        try {
            // $charge = Products::where('id', $product->id)->first();
            // $product_categories = ProductCategories::all();

            $logController->createLog(__METHOD__, 'success', 'Navigated to Charge Edit .', auth()->user(), '');

            return view('charge.edit', compact('charge'));
        } catch (Exception $e) {
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Charge $charge, Request $request, LogsController $logController)
    {
        try {
            $request->validate([
                'name' => 'required',
                'price' => 'required',
            ]);

            Charge::where('id', $charge->id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'status' => 1,
            ]);
            $logController->createLog(__METHOD__, 'success', 'Edited Charge', auth()->user(), json_encode($charge));

            return redirect()->to('/charges')->with('success', 'Record Updated SuccessFully!');
        } catch (Exception $e) {
            // dd($e);

            $logController->createLog(__METHOD__, 'error', 'Error on Edited Charge', auth()->user(), json_encode($charge));

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $charge = Charge::find($id);
            $charge->delete();

            return redirect()->back()->with('success', 'Record Deleted Succesfully!');
        } catch (Exception $e) {

            return redirect()->back()->with('error', '$e');
        }
    }
}
