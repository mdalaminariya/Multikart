<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Physical\Product\Product as PhysicalProduct;
use App\Models\Digital\Product\Product as DigitalProduct;

class QuickViewController extends Controller
{
    public function show($type, $id)
    {
        if ($type === 'physical') {

            $product = PhysicalProduct::with('images')->findOrFail($id);

            $images = collect();

            /*
            |--------------------------------------------------------------------------
            | Physical Product Main Image
            |--------------------------------------------------------------------------
            */
            if ($product->image) {
                $images->push(
                    asset('uploads/physical/products/' . $product->image)
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Physical Product Gallery Images
            |--------------------------------------------------------------------------
            */
            if ($product->images) {

                foreach ($product->images as $productImage) {

                    if (!empty($productImage->path)) {

                        $images->push(
                            asset('uploads/physical/products/' . $productImage->path)
                        );
                    }
                }
            }

            $description = $product->description ?? '';

        } elseif ($type === 'digital') {

            $product = DigitalProduct::findOrFail($id);

            $images = collect();

            /*
            |--------------------------------------------------------------------------
            | Digital Product Images
            |--------------------------------------------------------------------------
            */
            $digitalImages = $product->images;

            /*
            | If images are stored as JSON
            */
            if (is_string($digitalImages)) {

                $decoded = json_decode($digitalImages, true);

                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $digitalImages = $decoded;
                } else {
                    $digitalImages = [$digitalImages];
                }
            }

            /*
            | If images are already an array
            */
            if (is_array($digitalImages)) {

                foreach ($digitalImages as $digitalImage) {

                    if (is_string($digitalImage) && $digitalImage !== '') {

                        $images->push(
                            asset('uploads/digital/products/' . $digitalImage)
                        );
                    }
                }
            }

            $description = $product->short_summary
                ?? $product->description
                ?? '';

        } else {

            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Remove duplicate images
        |--------------------------------------------------------------------------
        */
        $images = $images
            ->filter()
            ->unique()
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Fallback image
        |--------------------------------------------------------------------------
        */
        $fallbackImage = asset(
            'assets/images/fashion-1/product/1.jpg'
        );

        /*
        |--------------------------------------------------------------------------
        | Make sure we always have 3 images for Multikart slider
        |--------------------------------------------------------------------------
        */
        if ($images->count() === 0) {

            $images->push($fallbackImage);
        }

        while ($images->count() < 3) {

            $images->push($images->first());
        }

        /*
        |--------------------------------------------------------------------------
        | Only use first 3 images
        |--------------------------------------------------------------------------
        */
        $images = $images->take(3)->values();

        return response()->json([

            'id' => $product->id,

            'type' => $type,

            'title' => $product->title,

            'price' => $product->price,

            'discount' => $product->discount ?? 0,

            'description' => $description,

            /*
            | Three actual product images
            */
            'images' => [
                $images[0],
                $images[1],
                $images[2],
            ],

            'details_url' => route(
                'product.details',
                [$type, $product->id]
            ),

            'cart_url' => route(
                'cart.add',
                [
                    'type' => $type,
                    'id' => $product->id,
                ]
            ),

            'compare_url' => route(
                'compare.add',
                [$type, $product->id]
            ),
        ]);
    }
}