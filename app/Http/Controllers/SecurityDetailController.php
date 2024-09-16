<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SecurityDetail;
use Illuminate\Http\Request;
use App\Models\Clients;
use App\Models\Type;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Session;

class SecurityDetailController extends Controller
{
    public function add()
    {
        $clients = Clients::where('status', 1)->get();
        $types = Type::all();
        return view('security_detail.add', compact('clients', 'types'));
    }
    public function store(Request $request, LogsController $logController)
    {
        try {
            $security_detail = SecurityDetail::create([
                'type_id' => $request->type_id,
                'date' => $request->date,
                'client_id' => $request->client_id,
                'token' => $request->token,
                'paid_to' => $request->paid_to,
                'amount' => $request->amount ?? 0,
                'description' => $request->description,
            ]);

            // if ($security_detail->paid_to != null) {
            //     SecurityDetail::create([
            //         'type_id' => 2,
            //         'date' => $request->date,
            //         'client_id' => $security_detail->paid_to,
            //         'token' => $request->token,
            //         'paid_to' => null,
            //         'amount' => $request->amount ?? 0,
            //         'description' => $request->description,
            //         // 'description' => 'Paid From ' . $security_detail->client->name . ' on ' . Carbon::now()->format('d/m/y'),
            //         'security_detail_id' => $security_detail->id,
            //     ]);
            // }

            $logController->createLog(__METHOD__, 'success', 'Security Detail Created.', auth()->user(), '');

            return redirect()->to('/client-profile/' . $request->client_id . '?section=receipt')->with('success', 'New Record Created SuccessFully!');

            // return redirect()->to('/invoice')->with('success', 'New Record Created SuccessFully!');
        } catch (Exception $e) {
            // dd($e->getMessage());
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(SecurityDetail $security_detail)
    {
        $clients = Clients::where('status', 1)->get();
        $types = Type::all();

        return view('security_detail.edit', compact('security_detail', 'clients', 'types'));
    }
    public function update(SecurityDetail $security_detail, Request $request, LogsController $logController)
    {
        // dd($request->all());
        try {
            SecurityDetail::where('id', $security_detail->id)->update([
                'type_id' => $request->type_id,
                'date' => $request->date,
                'client_id' => $request->client_id,
                'token' => $request->token,
                'paid_to' => $request->paid_to,
                'amount' => $request->amount ?? 0,
                'description' => $request->description,
            ]);

            // SecurityDetail::where('security_detail_id', $security_detail->id)->delete();
            // if ($request->paid_to != null) {
            //     SecurityDetail::create([
            //         'type_id' => 2,
            //         'date' => $request->date,
            //         'client_id' => $request->paid_to,
            //         'token' => $request->token,
            //         'paid_to' => null,
            //         'amount' => $request->amount ?? 0,
            //         'description' => $request->description,
            //         'security_detail_id' => $security_detail->id,
            //     ]);
            // }

            $logController->createLog(__METHOD__, 'success', 'security_detail Updated.', auth()->user(), $security_detail);
            return redirect()->to('/client-profile/' . $security_detail->client_id . '?section=receipt')->with('success', 'Record Updated SuccessFully!');

            // return redirect()->to('/invoice')->with('success', 'Record Updated SuccessFully!');
        } catch (Exception $e) {
            dd($e);
            $logController->createLog(__METHOD__, 'success', 'security_detail Updated Failed.', auth()->user(), $security_detail);

            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
}
