<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $table = 'otp';

    protected $fillable = [
        'nomor',
        'otp',
        'waktu'
    ];

    public $timestamps = false; // Karena tabel kamu tidak punya created_at & updated_at
}
