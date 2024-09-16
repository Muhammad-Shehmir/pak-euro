<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentStatus extends Model
{
    protected $table = 'appointment_status';
    protected $guarded = [];
    public $timestamps = true;

    public function visit_payments()
    {

        return $this->hasMany(Payments::class, 'visit_no');
    }
}
