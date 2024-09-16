<?php

namespace App\Models;

use App\Permissions\HasPermissionsTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Auth as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Passwordreset extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'password_resets';
    protected $guarded = [];

}
