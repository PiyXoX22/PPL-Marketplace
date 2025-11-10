<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Kalau mau dipakai untuk auth
use Illuminate\Notifications\Notifiable;

class Login extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nama tabel custom (karena bukan bentuk jamak)
    protected $table = 'login';

    // Primary key (default: id, jadi bisa di-skip sebenarnya)
    protected $primaryKey = 'id';

    // Laravel pakai timestamps (created_at, updated_at), karena tabel tidak punya → matikan
    public $timestamps = false;

    // Field yang bisa diisi mass assignment
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'phone',
        'password',
    ];

    // Hidden agar password tidak ikut kalau model diubah ke JSON
    protected $hidden = [
        'password',
    ];
}
