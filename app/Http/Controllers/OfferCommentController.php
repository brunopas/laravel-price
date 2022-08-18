<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\OfferComment;
use App\Http\Requests\StoreOfferCommentRequest;

class OfferCommentController extends Controller
{
    public function store(StoreOfferCommentRequest $request, Offer $offer)
    {
        $attributes = $request->validated();

        $attributes['offer_id'] = $offer->id;
        $attributes['user_id'] = auth()->user()->id;

        OfferComment::create($attributes);
        return redirect()->back()->with('success', 'Your comment has been added.');
    }
}
