<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    // Laravel harus tau primary key & auto increment
    protected $table = 'login_addresses';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'address_title',
        'first_name',
        'last_name',
        'phone',
        'address',
        'country_id',
        'state_id',
        'city_id',
        'zip_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function country()
    // {
    //     return $this->belongsTo(Country::class, 'country_id');
    // }

    // public function state()
    // {
    //     return $this->belongsTo(State::class, 'state_id');
    // }

    // public function city()
    // {
    //     return $this->belongsTo(City::class, 'city_id');
    // }
}
