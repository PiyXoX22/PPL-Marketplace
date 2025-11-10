<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qty extends Model
{
    use HasFactory;

    protected $table = 'qty';         // nama tabel di database
    protected $primaryKey = 'id_prod'; // primary key
    public $timestamps = false;        // tidak ada created_at / updated_at

    protected $fillable = [
        'qty',
    ];
}
