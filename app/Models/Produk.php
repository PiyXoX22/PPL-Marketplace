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
        'id',
        'nama_produk',
        'deskripsi'
    ];

    // Relasi ke tabel qty (1 produk punya 1 stok)
    public function stok()
    {
        return $this->hasOne(Qty::class, 'id_prod', 'id');
    }

    // Relasi ke tabel kategori (1 produk punya 1 kategori)
    public function kategori()
    {
        return $this->hasOne(Kategori::class, 'id_prod', 'id');
    }

    // Relasi ke tabel harga (1 produk punya 1 harga)
    public function harga()
    {
        return $this->hasOne(Harga::class, 'id_prod', 'id');
    }

    // Relasi ke tabel gambar (1 produk punya 1 gambar)
    public function gambar()
    {
        return $this->hasOne(Gambar::class, 'id_prod', 'id');
    }
}
