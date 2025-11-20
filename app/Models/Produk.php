<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama_produk',
        'deskripsi'
    ];

    public function stok()
    {
        return $this->hasOne(Qty::class, 'id_prod', 'id');
    }

    public function kategori()
    {
        return $this->hasOne(Kategori::class, 'id_prod', 'id');
    }

    public function harga()
    {
        return $this->hasOne(Harga::class, 'id_prod', 'id');
    }

    public function gambar()
    {
        return $this->hasOne(Gambar::class, 'id_prod', 'id');
    }
}
