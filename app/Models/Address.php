<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'login2_addresses'; // Nama tabel sesuai database

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'string'; // BIGINT UNSIGNED

    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'province',
        'city',
        'district',
        'postal_code',
        'address_line',
        'additional_info',
        'is_default'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
