<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    // protected $with = ['coupons'];

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }
}
