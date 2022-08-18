<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('coupons.index', [
            'title' => 'LAST COUPONS',
            'coupons' => Coupon::where('is_active', true)
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
        return view('coupons.create', [
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
            'store_id' => [Rule::exists('stores', 'id')],
            'code' => ['required', 'max:50'],
            'description' => ['required'],
            'application_rules' => []
        ]);

        $formFields['user_id'] = auth()->user()->id;

        $couponCreated = Coupon::create($formFields);
        return redirect('/coupons/')->with('message', 'Coupon created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return view('coupons.show', [
            'coupon' => $coupon
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('coupons.edit', [
            'stores' => Store::where('is_active', true)
                ->orderByDesc('name')
                ->get(),
            'coupon' => $coupon
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        if ($coupon->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'store_id' => [Rule::exists('stores', 'id')],
            'code' => ['required', 'max:50'],
            'description' => ['required'],
            'application_rules' => []
        ]);

        $coupon->update($formFields);
        return back()->with('message', 'Coupon updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        if ($coupon->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $coupon->delete();
        return redirect('/coupons')->with('message', 'Coupon deleted successfully!');
    }
}
