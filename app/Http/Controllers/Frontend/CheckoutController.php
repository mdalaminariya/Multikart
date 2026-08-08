<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Address;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $addresses = Address::where('user_id', auth()->id())->get();
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $coupons = Coupon::where('status', 'success')->latest()->take(2)->get();
        $discountCoupons = Coupon::where('status', 'success')->latest()->get();
        $subTotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $shipping = 0;
        $tax = 0;

        $total = $subTotal + $shipping + $tax;

        return view('frontend.carts.checkout.index', compact(
            'cartItems',
            'subTotal',
            'shipping',
            'tax',
            'total',
            'addresses',
            'coupons',
            'discountCoupons'
        ));
    }
}
