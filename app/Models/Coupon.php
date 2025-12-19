<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
        'code',
        'type',
        'value',
        'min_transaction',
        'max_discount',
        'expired_at',   // 🔥 WAJIB ADA
        'is_active',
    ];

    protected $casts = [
        'expired_at' => 'date',
        'is_active'  => 'boolean',
    ];
}
