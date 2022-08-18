<?php

namespace App\Models;

use App\Models\User;
use App\Models\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    // protected $with = ['store', 'author'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
