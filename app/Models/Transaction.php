<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'total', 'shipping_fee', 'shipping_courier', 'payment_method', 'status'
    ];

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
}

