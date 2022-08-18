<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\OfferLike;
use Illuminate\Support\Facades\Request;

class OfferLikeController extends Controller
{
    public function store(Request $request, Offer $offer)
    {
        $attributes['offer_id'] = $offer->id;
        $attributes['user_id'] = auth()->user()->id;

        OfferLike::create($attributes);
        return redirect()->back()->with('success', 'Your opinion has been added.');
    }
}
