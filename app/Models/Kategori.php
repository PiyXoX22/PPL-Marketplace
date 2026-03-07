<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'kategori',
        'gambar'
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_kategori', 'id');
    }
}