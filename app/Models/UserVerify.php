<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVerify extends Model
{
    use Notifiable;

    public $table = "verify_users";

    protected $fillable = [
        'user_id',
        'token',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
