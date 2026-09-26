<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Physical\Product\Product as PhysicalProduct;
use App\Models\Digital\Product\Product as DigitalProduct;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->search;

        $physicalProducts = PhysicalProduct::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('brand', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->get()
            ->map(function ($product) {
                $product->type = 'physical';
                return $product;
            });

        $digitalProducts = DigitalProduct::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('brand', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->get()
            ->map(function ($product) {
                $product->type = 'digital';
                return $product;
            });

        $products = $physicalProducts
            ->concat($digitalProducts)
            ->sortByDesc('created_at')
            ->values();

        return view('frontend.account.search.index', compact('products', 'search'));
    }
}