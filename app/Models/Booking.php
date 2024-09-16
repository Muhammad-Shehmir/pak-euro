<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;
    protected $table = 'rooms_booking';
    protected $guarded = [];
    public $timestamps = true;

    public function customer()
    {

        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function product()
    {

        return $this->belongsTo(Products::class, 'product_id');
    }

    public function day()
    {

        return $this->belongsTo(DayMaster::class, 'day_id');
    }

    public function customer_status()
    {

        return $this->hasOne(CustomerStatus::class, 'booking_id');
    }
}
