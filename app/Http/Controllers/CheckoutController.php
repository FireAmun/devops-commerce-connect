<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CheckoutController extends Controller
{
    public function applyCoupon(Request $request)
    {
        $cart = session()->get('cart', []);
        $coupon = Coupon::where('code', $request->coupon_code)
            ->where('status', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        if(!$coupon) {
            return back()->with('error', 'Invalid or expired coupon.');
        }

        session(['coupon' => $coupon]);
        return back()->with('success', 'Coupon applied!');
    }
}
