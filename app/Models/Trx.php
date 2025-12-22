<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Models;

class Trx extends Model
{
    protected $table = 'trx';
    public $timestamps = false;

    protected $primaryKey = 'id';       // ← WAJIB
    public $incrementing = false;       // ← WAJIB
    protected $keyType = 'string';      // ← WAJIB

    protected $fillable = [
    'id',
    'user_id',
    'tanggal',
    'total',
    'paid',
    'payment_method',
    'grand_total',
    'status'
];

    public function detail()
    {
        return $this->hasMany(TrxDetail::class, 'trx_id', 'id');
    }

}
