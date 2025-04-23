<?php

namespace App\Http\Controllers;

use App\Models\CouponCode;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CouponCodeController extends Controller
{
    /**
     * Display a listing of the coupon codes.
     */
    public function index()
    {
        $coupons = CouponCode::orderBy('created_at', 'desc')->get();
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new coupon code.
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created coupon code in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:coupon_codes',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'starts_at' => 'required|date',
            'expires_at' => 'required|date|after:starts_at',
            'is_active' => 'boolean'
        ]);

        CouponCode::create($validated);

        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon code created successfully.');
    }

    /**
     * Show the form for editing the specified coupon code.
     */
    public function edit(CouponCode $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified coupon code in storage.
     */
    public function update(Request $request, CouponCode $coupon)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:coupon_codes,code,' . $coupon->id,
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'starts_at' => 'required|date',
            'expires_at' => 'required|date|after:starts_at',
            'is_active' => 'boolean'
        ]);

        $coupon->update($validated);

        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon code updated successfully.');
    }

    /**
     * Remove the specified coupon code from storage.
     */
    public function destroy(CouponCode $coupon)
    {
        $coupon->delete();

        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon code deleted successfully.');
    }
} 