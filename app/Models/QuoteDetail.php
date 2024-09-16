<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteDetail extends Model
{
    protected $table = 'quote_detail';
    protected $guarded = [];
    public $timestamps = true;

    public function product()
    {

        return $this->belongsTo(Products::class, 'product_id');
    }

    public function doctor()
    {

        return $this->belongsTo(User::class, 'doctor_id');
    }
}
