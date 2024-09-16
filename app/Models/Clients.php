<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clients extends Model
{
    use SoftDeletes;

    protected $table = 'clients';
    protected $guarded = [];
    public $timestamps = true;

    public function customer_type()
    {
        return $this->belongsTo(CustomerTypeMaster::class, 'customer_type_id');
    }

    public function relation()
    {
        return $this->belongsTo(RelationshipMaster::class, 'relation_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function client_type()
    {
        return $this->belongsTo(ClientTypes::class, 'type_id');
    }

   
}
