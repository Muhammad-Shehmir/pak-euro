<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $table = 'shipments';
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Clients::class, 'client_id');
    }
    public function vendor()
    {
        return $this->belongsTo(Clients::class, 'vendor_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'delivery_city');
    }
    public function transaction()
    {
        return $this->belongsTo(Transactions::class, 'invoice_no', 'tran_no');
    }
    public function bill()
    {
        return $this->belongsTo(Transactions::class, 'bill_no', 'tran_no');
    }
}
