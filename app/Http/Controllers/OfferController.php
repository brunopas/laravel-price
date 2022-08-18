<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\OfferView;
use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('offers.index', [
            'title' => 'LAST OFFERS',
            'search' => request('search'),
            'offers' => Offer::where('is_active', true)
                ->filter(request(['search', 'tag']))
                ->orderByDesc('updated_at')
                ->paginate(20)
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTop()
    {
        $commentsCount = DB::table('offer_comments')
            ->select('offer_id', DB::raw('COUNT(1) as comments_count'))
            ->groupBy('offer_id');

        $topOffers = DB::table('offers')
            ->joinSub($commentsCount, 'comments_count', function ($join) {
                $join->on('offers.id', '=', 'comments_count.offer_id');
            })
            ->where('is_active', true)
            ->orderByDesc('comments_count')
            ->paginate(20);

        return view('offers.index', [
            'title' => 'TOP OFFERS',
            'offers' => $topOffers
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        return view('offers.manage', [
            'offers' => Offer::where('is_active', true)
                ->where('user_id', '=', auth()->user()->id)
                ->orderByDesc('updated_at')
                ->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('offers.create', [
            'stores' => Store::where('is_active', true)
                ->orderByDesc('name')
                ->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => ['required'],
            'url' => ['required', 'url'],
            'store_id' => [Rule::exists('stores', 'id')],
            'price' => ['required', 'numeric', 'min:0', 'max:99999'],
            'price_old' => ['required', 'numeric', 'min:0', 'max:99999'],
            'tags' => [],
            'description' => [],
            'coupon' => []
        ]);

        $formFields['user_id'] = auth()->user()->id;
        $formFields['slug'] = Str::slug($formFields['title']);

        if ($request->hasFile('thumbnail')) {
            $formFields['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $offerCreated = Offer::create($formFields);
        return redirect('/offers/' . $offerCreated->slug . '/show')->with('message', 'Offer created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        OfferView::create([
            'offer_id' => $offer->id
        ]);

        return view('offers.show', [
            'offer' => $offer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        return view('offers.edit', [
            'stores' => Store::where('is_active', true)
                ->orderByDesc('name')
                ->get(),
            'offer' => $offer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        if ($offer->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => ['required'],
            'url' => ['required', 'url'],
            'store_id' => [Rule::exists('stores', 'id')],
            'price' => ['required', 'numeric', 'min:0', 'max:99999'],
            'price_old' => ['required', 'numeric', 'min:0', 'max:99999'],
            'tags' => [],
            'description' => [],
            'coupon' => []
        ]);

        if ($request->hasFile('thumbnail')) {
            $formFields['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $offer->update($formFields);
        return back()->with('message', 'Offer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        if ($offer->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $offer->delete();
        return redirect('/')->with('message', 'Offer deleted successfully!');
    }
}
