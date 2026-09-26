<?php

namespace App\Providers;

use App\Models\Cart;

use App\Models\Feature\FeatureCategory;
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
            | Share Data With All Views
            |--------------------------------------------------------------------------
            */

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
            ]);
        });
    }
}
