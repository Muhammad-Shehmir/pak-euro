<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $connection = 'second_db';
    protected $table = 'logs';
    protected $guarded = [];
    public $timestamps = true;
}
