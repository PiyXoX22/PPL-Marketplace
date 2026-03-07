<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qty extends Model
{
    use HasFactory;

    protected $table = 'qty';
    protected $primaryKey = 'id_prod';
    public $incrementing = false;       // id_prod diisi manual
    public $timestamps = false;

    protected $fillable = [
        'id_prod',
        'qty',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_prod', 'id');
    }
}
