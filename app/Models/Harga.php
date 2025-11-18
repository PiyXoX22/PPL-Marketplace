<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    protected $table = 'harga';       // Nama tabel
    protected $primaryKey = 'id_prod'; // Primary key
    public $incrementing = false;      // Karena id_prod tidak AUTO_INCREMENT
    public $timestamps = false;        // Karena tidak ada kolom created_at / updated_at

    protected $fillable = [
        'id_prod',
        'harga',
    ];
    // RELASI → Harga milik satu produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_prod', 'id');
    }
}

