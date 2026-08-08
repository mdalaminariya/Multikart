<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\physical\category\Category as PhysicalCategory;
use App\Models\digital\category\Category as DigitalCategory;
use App\Models\Cart;
use Illuminate\Http\Request;

// Physical Product
use App\Models\Physical\Product\Product as PhysicalProduct;

// Digital Product
use App\Models\Digital\Product\Product as DigitalProduct;

class HomeController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | PRODUCTS (MERGED)
        |--------------------------------------------------------------------------
        */
        $physical = PhysicalProduct::with('subcategory')->latest()->get()->map(function ($item) {
            $item->type = 'physical';
            $item->image_path = asset('uploads/physical/products/' . $item->image);
            return $item;
        });

        $digital = DigitalProduct::with('subcategory')->latest()->get()->map(function ($item) {
            $item->type = 'digital';
            $item->image_path = asset('uploads/digital/products/' . $item->image);
            return $item;
        });

        $products = $physical
            ->merge($digital)
            ->sortByDesc('created_at')
            ->values();
        /*
        |--------------------------------------------------------------------------
        | GROUP PRODUCTS FOR TAB UI
        |--------------------------------------------------------------------------
        */

$groupedProducts = $products->groupBy(function ($product) {
    return optional($product->subcategory)->name ?? 'UNCATEGORIZED';
});

        return view('frontend.home.home', compact(
            'products',
            'groupedProducts'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | PRODUCT DETAILS (PHYSICAL AND DIGITAL)
    |--------------------------------------------------------------------------
    */
public function productDetails($type, $id)
{
    if ($type === 'physical') {
        $product = PhysicalProduct::with('images', 'subcategory')->findOrFail($id);
        $imagePath = 'uploads/physical/products/';
    } elseif ($type === 'digital') {
        $product = DigitalProduct::with('images', 'subcategory')->findOrFail($id);
        $imagePath = 'uploads/digital/products/';
    } else {
        abort(404);
    }

    $cartCount = Cart::where('product_id', $id)->count();

    $product->type = $type;
    $product->image_path = asset($imagePath . $product->image);

    // Calculate average rating and total reviews
    $reviews = $product->reviews;
    $totalReviews = $reviews->count();
    $avgRating = $totalReviews > 0 ? $reviews->avg('rating') : 0;

    return view('frontend.product.details', compact('product', 'imagePath', 'cartCount', 'totalReviews', 'avgRating'));
}

}
