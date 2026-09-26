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

public function shop(Request $request)
{
    /*
    |--------------------------------------------------------------------------
    | Selected Brands
    |--------------------------------------------------------------------------
    */

    $selectedBrands = $request->input('brand', []);

    if (!is_array($selectedBrands)) {
        $selectedBrands = [$selectedBrands];
    }

    $selectedBrands = collect($selectedBrands)
        ->filter()
        ->map(function ($brand) {
            return trim($brand);
        })
        ->values()
        ->toArray();


    /*
    |--------------------------------------------------------------------------
    | Selected Category / Subcategory
    |--------------------------------------------------------------------------
    */

    $type = $request->input('type');
    $categoryId = $request->input('category');
    $subcategoryId = $request->input('subcategory');


    /*
    |--------------------------------------------------------------------------
    | Physical Products
    |--------------------------------------------------------------------------
    */

    $physicalQuery = PhysicalProduct::query()
        ->with('subcategory');

    /*
    | Brand Filter
    */

    if (!empty($selectedBrands)) {

        $physicalQuery->where(function ($query) use ($selectedBrands) {

            foreach ($selectedBrands as $brand) {

                $query->orWhere(
                    'brand',
                    'LIKE',
                    '%' . $brand . '%'
                );
            }
        });
    }


    /*
    | Category / Subcategory Filter
    */

    if ($type === 'physical') {

        if (!empty($categoryId)) {

            $physicalQuery->whereHas('subcategory', function ($query) use ($categoryId) {

                $query->where('category_id', $categoryId);

            });
        }

        if (!empty($subcategoryId)) {

            $physicalQuery->where(
                'subcategory_id',
                $subcategoryId
            );
        }

    }


    $physicalProducts = $physicalQuery
        ->latest()
        ->get()
        ->map(function ($product) {

            $product->type = 'physical';

            $product->image_path = asset(
                'uploads/physical/products/' . $product->image
            );

            return $product;
        });


    /*
    |--------------------------------------------------------------------------
    | Digital Products
    |--------------------------------------------------------------------------
    */

    $digitalQuery = DigitalProduct::query()
        ->with('subcategory');

    /*
    | Brand Filter
    */

    if (!empty($selectedBrands)) {

        $digitalQuery->where(function ($query) use ($selectedBrands) {

            foreach ($selectedBrands as $brand) {

                $query->orWhere(
                    'brand',
                    'LIKE',
                    '%' . $brand . '%'
                );
            }
        });
    }


    /*
    | Category / Subcategory Filter
    */

    if ($type === 'digital') {

        if (!empty($categoryId)) {

            $digitalQuery->whereHas('subcategory', function ($query) use ($categoryId) {

                $query->where('category_id', $categoryId);

            });
        }

        if (!empty($subcategoryId)) {

            $digitalQuery->where(
                'subcategory_id',
                $subcategoryId
            );
        }

    }


    $digitalProducts = $digitalQuery
        ->latest()
        ->get()
        ->map(function ($product) {

            $product->type = 'digital';

            $product->image_path = asset(
                'uploads/digital/products/' . $product->image
            );

            return $product;
        });


    /*
    |--------------------------------------------------------------------------
    | Merge Physical + Digital Products
    |--------------------------------------------------------------------------
    */

    $products = $physicalProducts
        ->merge($digitalProducts)
        ->sortByDesc('created_at')
        ->values();


    /*
    |--------------------------------------------------------------------------
    | Get Brands From Physical Products
    |--------------------------------------------------------------------------
    */

    $physicalBrands = PhysicalProduct::whereNotNull('brand')
        ->where('brand', '!=', '')
        ->pluck('brand')
        ->toArray();


    /*
    |--------------------------------------------------------------------------
    | Get Brands From Digital Products
    |--------------------------------------------------------------------------
    */

    $digitalBrands = DigitalProduct::whereNotNull('brand')
        ->where('brand', '!=', '')
        ->pluck('brand')
        ->toArray();


    /*
    |--------------------------------------------------------------------------
    | Combine Physical + Digital Brands
    |--------------------------------------------------------------------------
    */

    $brands = collect(array_merge(
        $physicalBrands,
        $digitalBrands
    ))
        ->flatMap(function ($brand) {

            return explode(',', $brand);

        })
        ->map(function ($brand) {

            return trim($brand);

        })
        ->filter()
        ->unique()
        ->sort()
        ->values();


    /*
    |--------------------------------------------------------------------------
    | Return Shop
    |--------------------------------------------------------------------------
    */

    return view(
        'frontend.brand.index',
        compact(
            'products',
            'brands',
            'selectedBrands',
            'type',
            'categoryId',
            'subcategoryId'
        )
    );
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
