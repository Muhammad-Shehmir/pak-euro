<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRoles extends Model
{
    use HasFactory;

    protected $table = 'permission_role';
    protected $guarded = [];
    public $timestamps = false;

    public function permission_master()
    {
        return $this->belongsTo(Permission::class, 'permission_id', 'id');
    }

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'permission_role');
    // }

    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'users_permissions');
    // }
}
