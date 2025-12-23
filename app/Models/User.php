<?php

namespace App\Models;

use App\Models\Address;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'login';
    protected $primaryKey = 'id';

    public $timestamps = false;

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

    // RELASI USER → ADDRESS
    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id');
    }

    public function transaksi()
    {
        return $this->hasMany(Trx::class);
    }

}
