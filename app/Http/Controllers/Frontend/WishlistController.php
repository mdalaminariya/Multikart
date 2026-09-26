<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Physical\Product\Product as PhysicalProduct;
use App\Models\Digital\Product\Product as DigitalProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Wishlist Page
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())
            ->latest()
            ->get();

        foreach ($wishlists as $wishlist) {

            if ($wishlist->product_type === 'physical') {

                $product = PhysicalProduct::find($wishlist->product_id);

                if ($product) {

                    $wishlist->product = $product;

                    $wishlist->product_name = $product->title;

                    $wishlist->price = $product->price;

                    $wishlist->availability =
                        ($product->quantity ?? 0) > 0
                            ? 'in stock'
                            : 'out of stock';

                    $wishlist->image = $product->image
                        ? asset('uploads/physical/products/' . $product->image)
                        : asset('frontend/assets/images/fashion-1/product/17.jpg');

                }

            } elseif ($wishlist->product_type === 'digital') {

                $product = DigitalProduct::find($wishlist->product_id);

                if ($product) {

                    $wishlist->product = $product;

                    $wishlist->product_name = $product->title;

                    $wishlist->price = $product->price;

                    // Digital products are normally available
                    $wishlist->availability = 'in stock';

                    $images = json_decode($product->images, true);

                    if (is_array($images) && count($images) > 0) {

                        $wishlist->image =
                            asset('uploads/digital/products/' . $images[0]);

                    } else {

                        $wishlist->image =
                            asset('frontend/assets/images/fashion-1/product/17.jpg');
                    }
                }
            }
        }

        // Remove wishlist records whose products no longer exist
        $wishlists = $wishlists->filter(function ($wishlist) {
            return isset($wishlist->product);
        });

        return view('frontend.account.wishlist.index', compact('wishlists'));
    }


    /*
    |--------------------------------------------------------------------------
    | Add / Remove Wishlist
    |--------------------------------------------------------------------------
    */

    public function toggle(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'product_id' => 'required|integer',
            'product_type' => 'required|in:physical,digital',
        ]);

        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->where('product_type', $request->product_type)
            ->first();

        if ($wishlist) {

            $wishlist->delete();

            return back()->with(
                'wishlist_removed',
                'Product removed from wishlist.'
            );
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'product_type' => $request->product_type,
        ]);

        return back()->with(
            'wishlist_added',
            'Product added to wishlist.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Remove From Wishlist
    |--------------------------------------------------------------------------
    */

    public function remove($id)
    {
        Wishlist::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return back()->with(
            'wishlist_removed',
            'Product removed from wishlist.'
        );
    }
}