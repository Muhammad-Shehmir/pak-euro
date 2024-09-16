<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $guarded = [];
    public $timestamps = true;

    public function permissions()
    {
        return $this->hasMany(PermissionRoles::class, 'role_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
