<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trx extends Model
{
    protected $table = 'trx';
    public $timestamps = false;

    protected $primaryKey = 'id';       // ← WAJIB
    public $incrementing = false;       // ← WAJIB
    protected $keyType = 'string';      // ← WAJIB

    protected $fillable = [
        'id',
        'tanggal',
        'total',
        'paid',
        'payment_method',
        'grand_total'
    ];

    public function detail()
    {
        return $this->hasMany(TrxDetail::class, 'trx_id', 'id');
    }
}
