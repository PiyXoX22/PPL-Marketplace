<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    protected $table = 'gambar';
    protected $primaryKey = 'id_prod';
    public $timestamps = false;

    protected $fillable = [
        'id_prod',
        'gambar',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_prod', 'id');
    }
}

