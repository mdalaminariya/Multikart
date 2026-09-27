<?php

namespace App\Providers;

use App\Models\Cart;

use App\Models\Feature\FeatureCategory;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use App\Models\Physical\Product\Product as PhysicalProduct;
use App\Models\Digital\Product\Product as DigitalProduct;

use App\Models\Physical\Category\Category as PhysicalCategory;
use App\Models\Digital\Category\Category as DigitalCategory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    /*
    |--------------------------------------------------------------------------
    | Database Migration Paths
    |--------------------------------------------------------------------------
    */

    $this->loadMigrationsFrom([
        database_path('migrations/digital'),
        database_path('migrations/physical'),
    ]);


    /*
    |--------------------------------------------------------------------------
    | Global View Data
    |--------------------------------------------------------------------------
    */

    View::composer('*', function ($view) {

        /*
        |--------------------------------------------------------------------------
        | Cart
        |--------------------------------------------------------------------------
        */

        if (Auth::check()) {

            $cartItems = Cart::where(
                'user_id',
                Auth::id()
            )->get();

            $cartCount = $cartItems->sum('quantity');

            $cartTotal = $cartItems->sum(function ($item) {
                return $item->price * $item->quantity;
            });

        } else {

            $cartItems = collect();
            $cartCount = 0;
            $cartTotal = 0;
        }


        /*
        |--------------------------------------------------------------------------
        | Physical Products
        |--------------------------------------------------------------------------
        */

        $physicalProducts = PhysicalProduct::query()
            ->where('status', 'active')
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($product) {

                return (object) [
                    'id' => $product->id,
                    'title' => $product->title,
                    'type' => 'physical',
                    'image' => $product->image,
                    'price' => $product->price,
                ];
            });


        /*
        |--------------------------------------------------------------------------
        | Digital Products
        |--------------------------------------------------------------------------
        */

        $digitalProducts = DigitalProduct::query()
            ->where('status', 'enable')
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($product) {

                return (object) [
                    'id' => $product->id,
                    'title' => $product->title,
                    'type' => 'digital',
                    'image' => $product->images,
                    'price' => $product->price,
                ];
            });


        /*
        |--------------------------------------------------------------------------
        | Merge Physical + Digital Products
        |--------------------------------------------------------------------------
        */

        $headerProducts = $physicalProducts
            ->concat($digitalProducts)
            ->values();


        /*
        |--------------------------------------------------------------------------
        | Physical Categories
        |--------------------------------------------------------------------------
        */

        $physicalCategories = PhysicalCategory::query()
            ->with('subcategories')
            ->orderBy('name')
            ->get()
            ->map(function ($category) {

                $category->menu_type = 'physical';

                return $category;
            });


        /*
        |--------------------------------------------------------------------------
        | Digital Categories
        |--------------------------------------------------------------------------
        */

        $digitalCategories = DigitalCategory::query()
            ->with('subcategories')
            ->orderBy('name')
            ->get()
            ->map(function ($category) {

                $category->menu_type = 'digital';

                return $category;
            });


        /*
        |--------------------------------------------------------------------------
        | Merge Physical + Digital Categories
        |--------------------------------------------------------------------------
        */

        $menuCategories = $physicalCategories
            ->concat($digitalCategories)
            ->sortBy('name')
            ->values();

            /* |-----------------------------------------------------------------
                | Dynamic Feature Menu |
                ----------------------------------------------------------------- */

                $featureCategories = FeatureCategory::query()
                ->with(['features' => function ($query) { $query->
                orderBy('sort_order')->orderBy('id'); }])->orderBy('sort_order')->orderBy('id')->get();

/*
|--------------------------------------------------------------------------
| Dynamic Order Notifications |
--------------------------------------------------------------------------
*/

$orders = collect();
$notifications = collect();
$user = null;

if (Auth::check()) {
    $user = Auth::user();

    if ($user->role === 'admin') {
            $orders = Order::latest() ->take(10) ->get();
        }
    else {
            $orders = Order::where( 'user_id', Auth::id() ) ->latest() ->take(10) ->get();
            }
    }

    /*
    |------------------------------------------------------------------------
| Create Notification From Order Status |
--------------------------------------------------------------------------
*/

foreach ($orders as $order)
    { switch ($order->status) {

        /*
        |---------------------------------
        | Pending |
            -----------------------------------
        */

            case 'pending':
            $notifications->push([
                'icon' => 'shopping-bag',
                'color' => 'shopping-color',
                'title' => $user->role === 'admin' ? 'New order received' :
                'Order received', 'message' =>
                    $user->role === 'admin' ? 'Order #' . $order->order_number .
                    ' is waiting for processing.' : 'Your order #' .
                    $order->order_number . ' is waiting for processing.',
                    'date' => $order->updated_at, 'status' => 'pending',
                    'order_id' => $order->id, ]);
            break;

            /*
                |--------------------------------------------------------------------------
            | Processing |
            --------------------------------------------------------------------------
                */

            case 'processing':
                $notifications->push([
                        'icon' => 'package',
                        'color' => 'info-color',
                        'title' => 'Order is processing',
                        'message' => $user->role === 'admin' ? 'Order #' . $order->order_number .
                        ' is being processed.' : 'Your order #' . $order->order_number .
                        ' is being processed.', 'date' => $order->updated_at, 'status' => 'processing',
                    'order_id' => $order->id, ]);
                break;

                /*
                |--------------------------------------------------------------------------
                | Completed |
                --------------------------------------------------------------------------
                */

                case 'completed':
                    $notifications->push([

                    'icon' => 'check-circle',
                    'color' => 'success-color', 'title' => 'Order completed',
                    'message' => $user->role === 'admin' ? 'Order #' .
                    $order->order_number . ' has been completed.' : 'Your order #' .
                        $order->order_number . ' has been completed.', 'date' => $order->updated_at,
                        'status' => 'completed', 'order_id' => $order->id, ]);

                        break;

                        /*
                        |--------------------------------------------------------------------------
                        | Cancelled |
                        --------------------------------------------------------------------------
                        */

                        case 'cancelled':
                        $notifications->push([
                                'icon' => 'x-circle',
                                'color' => 'danger-color',
                                'title' => 'Order cancelled',
                                'message' => $user->role === 'admin' ? 'Order #' .
                                $order->order_number . ' has been cancelled.' : 'Your order #' .
                                $order->order_number . ' has been cancelled.', 'date' => $order->updated_at,
                                'status' => 'cancelled', 'order_id' => $order->id, ]);

                            break;

                            /*
                            |--------------------------------------------------------------------------
                            | Unknown Status |
                            -------------------------------------------------------------------------
                            */
                        default: $notifications->push([
                                'icon' => 'bell',
                                'color' => '',
                                'title' => 'Order update',
                                'message' => $user->role === 'admin' ? 'Order #' .
                                $order->order_number . ' has been updated.' : 'Your order #' .
                                $order->order_number . ' has been updated.', 'date' => $order->updated_at,
                                'status' => $order->status, 'order_id' => $order->id, ]);

                            break;
                            }
                        }

                    /* |--------------------------------------------------------------------------
                    | Notification Count |
                    --------------------------------------------------------------------------
                        */

                    $notificationCount = $notifications->count();


        $view->with([

                // Cart
                'cartItems' => $cartItems,
                'cartCount' => $cartCount,
                'cartTotal' => $cartTotal,

                // Header products
                'headerProducts' => $headerProducts,

                // Dynamic product menu
                'menuCategories' => $menuCategories,

                // Dynamic feature menu
                'featureCategories' => $featureCategories,

                // Dynamic order notifications
                'notifications' => $notifications,
                 'notificationCount' => $notificationCount,

            ]);
        });
    }
}
