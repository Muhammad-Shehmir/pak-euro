<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFamily extends Model
{
    // use HasFactory;
    protected $table = 'customer_family';
    protected $guarded = [];
    public $timestamps = true;

    public function customer()
    {

        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function relation()
    {

        return $this->belongsTo(RelationshipMaster::class, 'relation_id');
    }
}
