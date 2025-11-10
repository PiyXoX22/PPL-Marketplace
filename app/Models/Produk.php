<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk'; // nama tabel
    protected $primaryKey = 'id';
    public $timestamps = false; // karena tabel kamu tidak punya created_at & updated_at

    protected $fillable = [
        'nama_produk',
        'deskripsi'
    ];
}
