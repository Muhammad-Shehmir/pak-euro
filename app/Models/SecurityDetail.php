<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecurityDetail extends Model
{
    protected $table = 'security_detail';
    protected $guarded = [];
    public $timestamps = true;

    public function client()
    {

        return $this->belongsTo(Clients::class, 'client_id');
    }
}
