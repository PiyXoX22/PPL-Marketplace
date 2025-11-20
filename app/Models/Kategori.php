<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id_prod';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_prod',
        'kategori'
    ];

    public function barang()
    {
        return $this->belongsTo(Produk::class, 'id_prod', 'id');
    }
}
