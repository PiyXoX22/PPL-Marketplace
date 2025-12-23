<?php

namespace App\Models;

<<<<<<< Updated upstream
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> Stashed changes
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
<<<<<<< Updated upstream
    protected $table = 'reviews';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'rating',
        'review',
    ];
=======
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'produk_id',
        'nama',
        'rating',
        'komentar'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
>>>>>>> Stashed changes
}
