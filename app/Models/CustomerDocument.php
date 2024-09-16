<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerDocument extends Model
{
    protected $table = 'customer_document';
    protected $guarded = [];
    public $timestamps = true;

    public function customer()
    {

        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function customerDocumentImages()
    {

        return $this->hasMany(CustomerDocumentImage::class, 'customer_document_id');
    }
}
