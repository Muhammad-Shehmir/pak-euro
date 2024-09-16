<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Charge extends Model
{
    use SoftDeletes;
    protected $table = 'charges';
    protected $guarded = [];
    public $timestamps = true;

    // public function product_category()
    // {

    //     return $this->belongsTo(ProductCategories::class, 'product_category_id');
    // }
}
