<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductCategories extends Model
{
    use SoftDeletes;
    protected $table = 'product_categories';
    protected $guarded = [];
    public $timestamps = true;
}
