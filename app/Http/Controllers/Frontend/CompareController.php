<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Physical\Product\Product as PhysicalProduct;
use App\Models\Digital\Product\Product as DigitalProduct;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Add product to compare
    |--------------------------------------------------------------------------
    */
    public function add($type, $id)
    {
        $compare = session()->get('compare', []);

        // Check if product is already in compare
        foreach ($compare as $item) {
            if ($item['id'] == $id && $item['type'] == $type) {
                return redirect()
                    ->route('compare.index')
                    ->with('info', 'Product is already in compare.');
            }
        }

        // Maximum 4 products because Multikart compare table has 4 columns
        if (count($compare) >= 4) {
            return redirect()
                ->route('compare.index')
                ->with('error', 'You can compare maximum 4 products.');
        }

        $compare[] = [
            'id' => $id,
            'type' => $type,
        ];

        session()->put('compare', $compare);

        return redirect()
            ->route('compare.index')
            ->with('success', 'Product added to compare.');
    }


    /*
    |--------------------------------------------------------------------------
    | Compare page
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $compare = session()->get('compare', []);

        $products = collect();

        foreach ($compare as $item) {

            if ($item['type'] === 'physical') {

                $product = PhysicalProduct::find($item['id']);

            } elseif ($item['type'] === 'digital') {

                $product = DigitalProduct::find($item['id']);

            } else {
                $product = null;
            }

            if ($product) {
                $product->compare_type = $item['type'];
                $products->push($product);
            }
        }

        return view('frontend.compare', compact('products'));
    }


    /*
    |--------------------------------------------------------------------------
    | Remove one product
    |--------------------------------------------------------------------------
    */
    public function remove($type, $id)
    {
        $compare = session()->get('compare', []);

        $compare = collect($compare)
            ->reject(function ($item) use ($type, $id) {
                return $item['id'] == $id && $item['type'] == $type;
            })
            ->values()
            ->toArray();

        session()->put('compare', $compare);

        return redirect()
            ->route('compare.index')
            ->with('success', 'Product removed from compare.');
    }


    /*
    |--------------------------------------------------------------------------
    | Clear all compared products
    |--------------------------------------------------------------------------
    */
    public function clear()
    {
        session()->forget('compare');

        return redirect()
            ->route('compare.index')
            ->with('success', 'Compare list cleared.');
    }
}