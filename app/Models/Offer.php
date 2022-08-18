<?php

namespace App\Models;

use App\Models\User;
use App\Models\Store;
use App\Models\OfferLike;
use App\Models\OfferView;
use App\Models\OfferComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory;

    // protected $with = ['author', 'comments', 'likes', 'views'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }

        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(OfferComment::class);
    }

    public function likes()
    {
        return $this->hasMany(OfferLike::class);
    }

    public function views()
    {
        return $this->hasMany(OfferView::class);
    }
}
