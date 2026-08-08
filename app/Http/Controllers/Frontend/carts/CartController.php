<?php

namespace App\Http\Controllers\Frontend\carts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Physical\Product\Product as PhysicalProduct;
use App\Models\Digital\Product\Product as DigitalProduct;
use App\Models\Cart;

class CartController extends Controller
{
public function index()
{
    $cartItems = Cart::where('user_id', auth()->id())->get();

    $cartTotal = $cartItems->sum(function ($item) {
        return $item->price * $item->quantity;
    });

    return view('frontend.carts.index', compact(
        'cartItems',
        'cartTotal'
    ));
}
public function add(Request $request, $type, $id)
{
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $product = $type == 'physical'
        ? PhysicalProduct::findOrFail($id)
        : DigitalProduct::findOrFail($id);

    try {

        $cart = Cart::create([
            'user_id'      => auth()->id(),
            'product_id'   => $product->id,
            'product_type' => $type,
            'price'        => $product->price,
            'quantity'     => 1,
        ]);

  return back()->with('success', 'Product added to cart successfully.');
    } catch (\Exception $e) {
        return back()->with('error', 'Failed to add product to cart.');

    }
}

public function increase($id)
{
    $cart = Cart::where('id',$id)
        ->where('user_id',auth()->id())
        ->firstOrFail();

    $cart->increment('quantity');

    return back();
}

public function decrease($id)
{
    $cart = Cart::where('id',$id)
        ->where('user_id',auth()->id())
        ->firstOrFail();

    if($cart->quantity > 1){
        $cart->decrement('quantity');
    }

    return back();
}

public function remove($id)
{
    Cart::where('id',$id)
        ->where('user_id',auth()->id())
        ->delete();

    return back()->with('success','Product removed.');
}

public function clear()
{
    Cart::where('user_id',auth()->id())->delete();

    return back()->with('success','Cart cleared.');
}

}
