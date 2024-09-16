<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    protected $table = 'notes';
    protected $guarded = [];
    public $timestamps = true;

    public function added_by()
    {

        return $this->belongsTo(User::class, 'created_by');
    }
}
