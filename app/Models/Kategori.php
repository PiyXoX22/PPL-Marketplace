<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';       // nama tabel
    protected $primaryKey = 'id_prod';   // primary key
    public $timestamps = false;          // tidak ada kolom created_at/updated_at

    protected $fillable = [
        'kategori',
    ];
}
