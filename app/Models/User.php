<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'login';
    protected $primaryKey = 'id';

    public $timestamps = false;  // tabel login tidak punya created_at & updated_at

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'phone',
        'password',
        'role_id',
        'remember_token'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    // RELASI USER → ROLE
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function address()
    {
        return $this->belongsTo(Role::class, 'user_id');
    }
}
