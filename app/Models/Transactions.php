<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model
{
    protected $table = 'transactions';
    protected $guarded = [];
    public $timestamps = true;

    use SoftDeletes;

    public function clients()
    {

        return $this->belongsTo(Clients::class, 'client_id');
    }
    
    public function charge()
    {

        return $this->belongsTo(Charge::class, 'charge_id');
    }

    public function payments()
    {

        return $this->hasMany(Payments::class, 'transaction_id');
    }

    public function transaction_detail()
    {

        return $this->hasMany(TransactionsDetail::class, 'transactions_id');
    }

    public function currency()
    {

        return $this->belongsTo(Currencies::class, 'currency_id');
    }

}
