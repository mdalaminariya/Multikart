<?php

namespace App\Http\Controllers\Backend\HomeController;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Physical\Product\Product as PhysicalProduct;
use App\Models\Digital\Product\Product as DigitalProduct;
use App\Models\User;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function index(){
        $monthlyEarnings = Order::where('status', 'completed')->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)
            ->sum('total');

                    // Physical products added this month
        $physicalProducts = PhysicalProduct::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Digital products added this month
        $digitalProducts = DigitalProduct::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
            // Total products added this month
        $monthlyProducts = $physicalProducts + $digitalProducts;

        $monthlyVendors = User::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)
    ->count();

    $orders = Order::latest()->take(5)->get();

        return view('backend.home.home', compact('monthlyEarnings','monthlyProducts','monthlyVendors','orders'));
    }
    public function salesOrders(){
        $salesOrders = Order::with('items')->latest()->take(10)->get();
        return view('backend.sales.orders', compact('salesOrders'));
    }

    public function transaction(){
        $orders = Order::latest()->take(10)->get();
        return view('backend.sales.transactions', compact('orders'));
    }
}
