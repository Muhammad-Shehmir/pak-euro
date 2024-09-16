<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceiptPayment extends Model
{
    protected $table = 'receipt_payment';
    protected $guarded = [];
    public $timestamps = true;

    use SoftDeletes;

    public function clients()
    {

        return $this->belongsTo(Clients::class, 'client_id');
    }
    
    public function currency()
    {

        return $this->belongsTo(Currencies::class, 'currency_id');
    }
    public function type()
    {

        return $this->belongsTo(Type::class, 'type_id');
    }

}
