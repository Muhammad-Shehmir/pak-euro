<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use SoftDeletes;
    protected $table = 'quote';
    protected $guarded = [];
    public $timestamps = true;

    public function customer()
    {

        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function quote_detail()
    {

        return $this->hasMany(QuoteDetail::class, 'quote_id');
    }

    public function currency()
    {

        return $this->belongsTo(Currencies::class, 'currency_id');
    }

}
