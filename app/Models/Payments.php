<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'payments';
    protected $guarded = [];
    public $timestamps = true;

    public function currency()
    {

        return $this->belongsTo(Currencies::class, 'currency_id');
    }

}
