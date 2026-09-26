<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\AccountSetting;
use App\Models\Vendor;
use App\Models\Review;

use App\Models\Physical\Product\Product as PhysicalProduct;
use App\Models\Digital\Product\Product as DigitalProduct;
use App\Models\OrderItem;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | VENDOR DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = Auth::user();

        // Only vendor can access vendor dashboard
        if ($user->role !== 'vendor') {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | Get or create vendor profile
        |--------------------------------------------------------------------------
        */

        $vendor = Vendor::firstOrCreate([
            'user_id' => $user->id
        ]);

        /*
        |--------------------------------------------------------------------------
        | Get vendor account settings
        |--------------------------------------------------------------------------
        */

        $setting = AccountSetting::firstOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'first_name' => $user->fname,
                'last_name' => $user->lname,
                'email' => $user->email,
                'allow_notifications' => 0,
                'enable_notifications' => 0,
                'own_activity_notification' => 0,
                'dnd' => 0,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Vendor Physical Products
        |--------------------------------------------------------------------------
        */

        $physicalProducts = PhysicalProduct::where(
                'user_id',
                $user->id
            )
            ->with('subcategory')
            ->latest()
            ->get()
            ->map(function ($product) {

                $product->product_type = 'physical';

                $product->display_image = $product->image
                    ? asset(
                        'uploads/physical/products/' .
                        $product->image
                    )
                    : asset(
                        'assets/images/fashion-1/product/5.jpg'
                    );

                $product->display_price =
                    $product->discount ?? $product->price;

                $product->display_stock =
                    $product->quantity;

                $product->display_sales = 0;

                return $product;
            });

        /*
        |--------------------------------------------------------------------------
        | Vendor Digital Products
        |--------------------------------------------------------------------------
        */

        $digitalProducts = DigitalProduct::where(
                'user_id',
                $user->id
            )
            ->with('subcategory')
            ->latest()
            ->get()
            ->map(function ($product) {

                $product->product_type = 'digital';

                $images = json_decode(
                    $product->images,
                    true
                );

                if (
                    is_array($images) &&
                    count($images) > 0
                ) {
                    $product->display_image = asset(
                        'uploads/digital/products/' .
                        $images[0]
                    );
                } else {
                    $product->display_image = asset(
                        'assets/images/fashion-1/product/5.jpg'
                    );
                }

                $product->display_price =
                    $product->price;

                $product->display_stock =
                    $product->quantity;

                $product->display_sales = 0;

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
        | Get Vendor Product IDs
        |--------------------------------------------------------------------------
        */

        $physicalProductIds = PhysicalProduct::where(
                'user_id',
                $user->id
            )
            ->pluck('id');

        $digitalProductIds = DigitalProduct::where(
                'user_id',
                $user->id
            )
            ->pluck('id');

        /*
        |--------------------------------------------------------------------------
        | Vendor Orders
        |--------------------------------------------------------------------------
        |
        | order_items does NOT have user_id.
        |
        | Vendor orders are identified by:
        |
        | product_type + product_id
        |
        */

        $orders = OrderItem::with('order')
            ->where(function ($query) use (
                $physicalProductIds,
                $digitalProductIds
            ) {

                $query->where(function ($q) use (
                    $physicalProductIds
                ) {

                    $q->where(
                        'product_type',
                        'physical'
                    )
                    ->whereIn(
                        'product_id',
                        $physicalProductIds
                    );

                })
                ->orWhere(function ($q) use (
                    $digitalProductIds
                ) {

                    $q->where(
                        'product_type',
                        'digital'
                    )
                    ->whereIn(
                        'product_id',
                        $digitalProductIds
                    );

                });

            })
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Total Products
        |--------------------------------------------------------------------------
        */

        $totalProducts =
            $physicalProducts->count()
            +
            $digitalProducts->count();

        /*
        |--------------------------------------------------------------------------
        | Total Sales
        |--------------------------------------------------------------------------
        */

        $totalSales = $orders->sum(function ($item) {

            return
                ($item->price ?? 0)
                *
                ($item->quantity ?? 1);
        });

        /*
        |--------------------------------------------------------------------------
        | Pending Orders
        |--------------------------------------------------------------------------
        */

        $pendingOrders = $orders
            ->filter(function ($item) {

                return
                    $item->order
                    &&
                    $item->order->status === 'pending';
            })
            ->unique('order_id')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | MONTHLY SALES
        |--------------------------------------------------------------------------
        */

        $monthlySales = collect();

        for ($month = 1; $month <= 12; $month++) {

            $monthlySales->put(
                Carbon::create(
                    null,
                    $month,
                    1
                )->format('M'),
                0
            );
        }

        foreach ($orders as $item) {

            // Use actual order date
            if (
                !$item->order ||
                !$item->order->created_at
            ) {
                continue;
            }

            $month = Carbon::parse(
                $item->order->created_at
            )->format('M');

            $sales =
                ($item->price ?? 0)
                *
                ($item->quantity ?? 1);

            $monthlySales->put(
                $month,
                $monthlySales->get($month, 0) + $sales
            );
        }

        /*
        |--------------------------------------------------------------------------
        | MONTHLY ORDERS
        |--------------------------------------------------------------------------
        */

        $monthlyOrders = collect();

        for ($month = 1; $month <= 12; $month++) {

            $monthlyOrders->put(
                Carbon::create(
                    null,
                    $month,
                    1
                )->format('M'),
                0
            );
        }

        foreach (
            $orders->groupBy(function ($item) {

                if (
                    !$item->order ||
                    !$item->order->created_at
                ) {
                    return null;
                }

                return Carbon::parse(
                    $item->order->created_at
                )->format('M');

            }) as $month => $items
        ) {

            if (!$month) {
                continue;
            }

            $monthlyOrders->put(
                $month,
                $items
                    ->unique('order_id')
                    ->count()
            );
        }

        /*
        |--------------------------------------------------------------------------
        | TRENDING PRODUCTS
        |--------------------------------------------------------------------------
        */

$trendingProducts = $orders
    ->groupBy(function ($item) {
        return $item->product_type . '-' . $item->product_id;
    })
    ->map(function ($items) {

        $firstItem = $items->first();

        $sales = 0;

        foreach ($items as $item) {
            $sales += $item->quantity ?? 1;
        }

        return [
            'product_id' => $firstItem->product_id,
            'product_type' => $firstItem->product_type,
            'sales' => $sales,
            'price' => $firstItem->price ?? 0,
        ];
    })
    ->sortByDesc('sales')
    ->take(5)
    ->values();

        /*
        |--------------------------------------------------------------------------
        | Dashboard View
        |--------------------------------------------------------------------------
        */

        return view(
            'frontend.vendor.dashboard',
            compact(
                'user',
                'vendor',
                'setting',
                'products',
                'orders',
                'totalProducts',
                'totalSales',
                'pendingOrders',
                'monthlySales',
                'monthlyOrders',
                'trendingProducts'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | VENDOR PROFILE
    |--------------------------------------------------------------------------
    */

public function vendorprofile()
{
    $user = Auth::user();

    if ($user->role !== 'vendor') {
        abort(403);
    }

    $vendor = Vendor::firstOrCreate([
        'user_id' => $user->id
    ]);

    // Get all physical products of this vendor
    $allProducts = PhysicalProduct::where('user_id', $user->id)
        ->with('subcategory')
        ->latest()
        ->get();

    // =========================
    // DYNAMIC COLOURS
    // =========================

    $colors = collect();

    foreach ($allProducts as $product) {

        if (empty($product->colors)) {
            continue;
        }

        $productColors = $product->colors;

        // If colors are stored as JSON
        if (is_string($productColors)) {

            $decodedColors = json_decode($productColors, true);

            if (
                json_last_error() === JSON_ERROR_NONE &&
                is_array($decodedColors)
            ) {
                $productColors = $decodedColors;
            } else {

                // If colors are stored like:
                // Red,Blue,Green
                $productColors = explode(',', $productColors);
            }
        }

        // Add every product color
        if (is_array($productColors)) {

            foreach ($productColors as $color) {

                $color = trim((string) $color);

                if ($color !== '') {
                    $colors->push($color);
                }
            }
        }
    }

    // Remove duplicates and sort alphabetically
    $colors = $colors
        ->unique()
        ->sort()
        ->values();

    // =========================
    // PAGINATED PRODUCTS
    // =========================

    $products = PhysicalProduct::where('user_id', $user->id)
        ->with('subcategory')
        ->latest()
        ->paginate(12);

    $products->getCollection()->transform(function ($product) {

        $product->type = 'physical';

        $product->display_image = $product->image
            ? asset('uploads/physical/products/' . $product->image)
            : asset('assets/images/product/placeholder.jpg');

        $product->display_price = $product->price;
        $product->display_stock = $product->quantity;

        return $product;
    });

    // Reviews
    $productIds = $allProducts->pluck('id');

    $totalReviews = Review::whereIn('product_id', $productIds)->count();

    $averageRating = Review::whereIn('product_id', $productIds)
        ->avg('rating');

    $ratingCounts = Review::whereIn('product_id', $productIds)
        ->selectRaw('rating, COUNT(*) as total')
        ->groupBy('rating')
        ->orderByDesc('rating')
        ->pluck('total', 'rating');

    $totalProducts = $productIds->count();

// =========================
// PRICE RANGE
// =========================

$priceQuery = PhysicalProduct::where('user_id', $user->id);

$minPrice = (float) ($priceQuery->min('price') ?? 0);
$maxPrice = (float) ($priceQuery->max('price') ?? 0);

// If there are no products
if ($maxPrice <= 0) {
    $minPrice = 0;
    $maxPrice = 1000000; // Set a default max price
}

// If all products have the same price
if ($minPrice == $maxPrice) {
    $maxPrice = $minPrice + 1;
}

    return view('frontend.vendor.profile', compact(
        'vendor',
        'user',
        'products',
        'allProducts',
        'colors',
        'totalProducts',
        'totalReviews',
        'averageRating',
        'ratingCounts',
        'minPrice',
        'maxPrice'
    ));
}


    /*
    |--------------------------------------------------------------------------
    | VENDOR PROFILE UPDATE
    |--------------------------------------------------------------------------
    */

    public function vendorProfileUpdate(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'vendor') {
            abort(403);
        }

        $request->validate([
            'store_name' =>
                'nullable|string|max:255',

            'country' =>
                'nullable|string|max:255',

            'phone' =>
                'nullable|string|max:20',

            'year_established' =>
                'nullable|string|max:10',

            'total_employees' =>
                'nullable|integer|min:0',

            'category' =>
                'nullable|string|max:255',

            'address' =>
                'nullable|string|max:255',

            'city' =>
                'nullable|string|max:255',

            'zip' =>
                'nullable|string|max:20',
        ]);

        Vendor::updateOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'store_name' =>
                    $request->store_name,

                'country' =>
                    $request->country,

                'phone' =>
                    $request->phone,

                'year_established' =>
                    $request->year_established,

                'total_employees' =>
                    $request->total_employees,

                'category' =>
                    $request->category,

                'address' =>
                    $request->address,

                'city' =>
                    $request->city,

                'zip' =>
                    $request->zip,
            ]
        );

        return back()->with(
            'success',
            'Profile updated successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE NOTIFICATIONS
    |--------------------------------------------------------------------------
    */

    public function updateNotifications(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'vendor') {
            abort(403);
        }

        $setting = AccountSetting::firstOrCreate([
            'user_id' => $user->id
        ]);

        $setting->update([
            'allow_notifications' =>
                $request->boolean(
                    'allow_notifications'
                ),

            'enable_notifications' =>
                $request->boolean(
                    'enable_notifications'
                ),

            'own_activity_notification' =>
                $request->boolean(
                    'own_activity_notification'
                ),

            'dnd' =>
                $request->boolean('dnd'),
        ]);

        return back()->with(
            'success',
            'Notification settings updated successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DEACTIVATE ACCOUNT
    |--------------------------------------------------------------------------
    */

    public function deactivate(Request $request)
    {
        $request->validate([
            'deactivation_reason' =>
                'required|string|max:255',
        ]);

        $user = Auth::user();

        if ($user->role !== 'vendor') {
            abort(403);
        }

        $setting = AccountSetting::firstOrCreate([
            'user_id' => $user->id
        ]);

        $setting->update([
            'deactivation_reason' =>
                $request->deactivation_reason,
        ]);

        $user->update([
            'is_deactivated' => true,
        ]);

        Auth::logout();

        return redirect('/')
            ->with(
                'success',
                'Your account has been deactivated.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE ACCOUNT
    |--------------------------------------------------------------------------
    */

    public function deleteAccount(Request $request)
    {
        $request->validate([
            'deletion_reason' =>
                'required|string|max:255',
        ]);

        $user = Auth::user();

        if ($user->role !== 'vendor') {
            abort(403);
        }

        $setting = AccountSetting::firstOrCreate([
            'user_id' => $user->id
        ]);

        $setting->update([
            'deletion_reason' =>
                $request->deletion_reason,
        ]);

        Auth::logout();

        /*
        |--------------------------------------------------------------------------
        | Delete User
        |--------------------------------------------------------------------------
        |
        | vendors.user_id has ON DELETE CASCADE,
        | so the vendor record will also be deleted.
        |
        */

        $user->delete();

        return redirect('/')
            ->with(
                'success',
                'Your account has been deleted.'
            );
    }
}
