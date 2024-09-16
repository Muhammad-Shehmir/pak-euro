<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Shipper extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no', 'date', 'shipper_name', 'marks_and_numbers', 'bl_no',
        'vessel_voy', 'bags', 'city', 'hcl', 'imcont_no', 'expc_no',
        'landing_date', 'eway_bill', 'rtgs_amount', 'delivery_status',
        'vehicle_and_driver', 'delivery_address'
    ];

    public static function validate($data)
    {
        return Validator::make($data, [
            'invoice_no' => 'required',
            'date' => 'required',
            'shipper_name' => 'required',
            'marks_and_numbers' => 'required',
            'bl_no' => 'required',
            'vessel_voy' => 'required',
            'bags' => 'required',
            'delivery_city' => 'required',
            'hcl' => 'required',
            'imcont_no' => 'required',
            'expc_no' => 'required',
            'landing_date' => 'required',
            'eway_bill' => 'required',
            'rtgs_amount' => 'nullable',
            'delivery_status' => 'required',
            'vehicle_and_driver' => 'required',
            'delivery_address' => 'required',
        ]);
    }
}
