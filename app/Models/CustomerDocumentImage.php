<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerDocumentImage extends Model
{
    protected $table = 'customer_document_images';
    protected $guarded = [];
    public $timestamps = true;

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function customerDocument()
    {
        return $this->belongsTo(CustomerDocument::class, 'customer_document_id');
    }
}

