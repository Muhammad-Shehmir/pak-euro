<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientTypes extends Model
{

    protected $table = 'client_type';
    protected $guarded = [];
    public $timestamps = true;


   
}
