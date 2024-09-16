<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerArrivalDeparture extends Model
{
    protected $table = 'customer_arrival_departure';
    protected $guarded = [];
    public $timestamps = true;

    public function customer()
    {

        return $this->belongsTo(Customers::class, 'customer_id');
    }


}
