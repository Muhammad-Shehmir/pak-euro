<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class LogsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createLog($function, $status, $message, $user, $previous)
    {
        Logs::create([
            'user_id' => $user ? $user->id : null,
            'log_date' => Carbon::now(),
            'function' => $function,
            'path' => request()->url(),
            'previous_value' => $previous,
            'request_payload' => json_encode(request()->all()),
            'log_status' => $status,
            'message' => $message,
        ]);
    }
}
