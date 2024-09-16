<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LogsController;
use App\Models\Procedure;
use App\Models\ProductCategories;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ProductCategoryController extends BaseController
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

            $product_categories = ProductCategories::when($name, function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            })->orderBy('created_at', 'desc')
                ->paginate($perPage);
            $logController->createLog(__METHOD__, 'success', 'Viewed Product Categories Index.', auth()->user(), '');

            return view('productCategories.index', compact('product_categories', 'perPage'));
        } catch (Exception $e) {
            dd($e);

            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function add(LogsController $logController)
    {
        try {

            $logController->createLog(__METHOD__, 'success', 'Navigated to Product Categories Add .', auth()->user(), '');

            return view('productCategories.add');
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

            $procedures = ProductCategories::create([
                'name' => $request->name,
                'status' => 1,

            ]);
            $logController->createLog(__METHOD__, 'success', 'Product Category Created.', auth()->user(), '');

            // dd($request->all());

            return redirect()->to('/product-categories ')->with('success', 'New Record Created SuccessFully!');
        } catch (Exception $e) {
            // dd($e);
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(ProductCategories $productCategory, LogsController $logController)
    {
        try {
            $productCategories = ProductCategories::where('id', $productCategory->id)->first();

            $logController->createLog(__METHOD__, 'success', 'Navigated to ProductCategories Edit .', auth()->user(), '');

            return view('productCategories.edit', compact('productCategories'));
        } catch (Exception $e) {
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(ProductCategories $productCategory, Request $request, LogsController $logController)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);

            $productCategories = ProductCategories::where('id', $productCategory->id)->update([
                'name' => $request->name,
                'status' => 1,
            ]);
            $logController->createLog(__METHOD__, 'success', 'Edited ProductCategories', auth()->user(), json_encode($productCategories));

            return redirect()->to('/product-categories')->with('success', 'Record Updated SuccessFully!');
        } catch (Exception $e) {
            // dd($e);

            $logController->createLog(__METHOD__, 'error', 'Error on Edited Procedure', auth()->user(), json_encode($productCategories));

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $productCategories = ProductCategories::find($id);
            $productCategories->delete();

            return redirect()->back()->with('success', 'Record Deleted Succesfully!');
        } catch (Exception $e) {

            return redirect()->back()->with('error', '$e');
        }
    }
}
