<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class TrxDetail extends Model
{
    protected $table = 'trx_detail';
    public $timestamps = false;

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'trx_id',
        'id_barang',
        'qty',
        'harga_satuan',
        'subtotal'
    ];

    public function trx()
    {
        return $this->belongsTo(Trx::class, 'trx_id', 'id');
    }
    public function produk()
{
    return $this->belongsTo(Produk::class, 'id_barang', 'id');
}
}
