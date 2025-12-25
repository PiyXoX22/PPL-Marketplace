<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    // ✅ RELASI REVIEW YANG BENAR
    public function reviews()
    {
        return $this->hasMany(Review::class, 'produk_id', 'id');
    }

    // ✅ CEK SUDAH BEL


// GANTI METHOD INI
public function sudahDibeliOleh($userId)
{
    return true; // sementara (opsi B)
}


}
