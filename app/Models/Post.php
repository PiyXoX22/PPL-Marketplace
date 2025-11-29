<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts'; // optional, default Laravel sudah ambil nama tabel
    protected $fillable = ['title', 'content'];
}
