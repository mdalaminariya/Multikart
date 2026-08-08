<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // database migration path
         $this->loadMigrationsFrom([
            database_path('migrations/digital'),
            database_path('migrations/physical'),
        ]);

 View::composer('*', function ($view) {

    if(Auth::check()){

        $cartItems = Cart::where('user_id',Auth::id())->get();

        $cartCount = $cartItems->sum('quantity');

        $cartTotal = $cartItems->sum(function($item){
            return $item->price * $item->quantity;
        });

    }else{

        $cartItems = collect();

        $cartCount = 0;

        $cartTotal = 0;

    }

    $view->with(compact(
        'cartItems',
        'cartCount',
        'cartTotal'
    ));
});
    }
}
