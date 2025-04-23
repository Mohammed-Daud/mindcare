<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CouponCode;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CouponCodeController extends Controller
{
    public function index()
    {
        $coupons = CouponCode::latest()->paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:coupon_codes,code',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'max_uses' => 'nullable|integer|min:1',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after:starts_at',
            'description' => 'nullable|string',
        ]);

        $validated['is_active'] = true;
        $validated['used_count'] = 0;

        CouponCode::create($validated);

        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon code created successfully.');
    }

    public function edit(CouponCode $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, CouponCode $coupon)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:coupon_codes,code,' . $coupon->id,
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'max_uses' => 'nullable|integer|min:1',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after:starts_at',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $coupon->update($validated);

        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon code updated successfully.');
    }

    public function destroy(CouponCode $coupon)
    {
        $coupon->delete();

        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon code deleted successfully.');
    }
} 