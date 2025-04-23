<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CouponCode;
use Carbon\Carbon;

class CouponCodeSeeder extends Seeder
{
    public function run()
    {
        CouponCode::create([
            'code' => 'WELCOME100',
            'type' => 'percentage',
            'value' => 100,
            'description' => 'Limited time offer: 100% discount on your first session',
            'starts_at' => Carbon::now(),
            'expires_at' => Carbon::now()->addMonths(3),
            'is_active' => true,
        ]);
    }
} 