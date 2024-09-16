<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionsDetail extends Model
{
    protected $table = 'transactions_detail';
    protected $guarded = [];
    public $timestamps = true;


    public function currency()
    {

        return $this->belongsTo(Currencies::class, 'currency_id');
    }

    public function charge()
    {

        return $this->belongsTo(Charge::class, 'charge_id');
    }

}
