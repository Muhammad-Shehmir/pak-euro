<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RoleUser extends Model
{
    use HasFactory;

    protected $table = 'role_user';
    // protected $primaryKey = 'user_id';
    protected $guarded = [];
    public $timestamps = false;

    
}
