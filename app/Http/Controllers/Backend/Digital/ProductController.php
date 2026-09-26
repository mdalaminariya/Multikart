<?php

namespace App\Http\Controllers\Backend\Digital;

use App\Http\Controllers\Controller;
use App\Models\Digital\Product\Product;
use App\Models\Digital\Product\ProductImage;
use App\Models\Digital\category\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADD PRODUCT PAGE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $subcategories = SubCategory::latest()->get();

        return view(
            'backend.digital.product.index',
            compact('subcategories')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'subcategory_id' => 'required',
            'title'         => 'required',
            'brand'         => 'required',
            'product_code'  => 'required|unique:digital_products,product_code',
            'price'         => 'required',
            'discount'      => 'required',
            'quantity'      => 'required',
            'description'   => 'required',
            'image'         => 'required|image',
            'images.*'      => 'image',
        ]);


        /*
        |--------------------------------------------------------------------------
        | MAIN IMAGE UPLOAD
        |--------------------------------------------------------------------------
        */

        $mainImageName = null;

        if ($request->hasFile('image')) {

            $main = $request->file('image');

            $mainImageName = time()
                . '_main.'
                . $main->getClientOriginalExtension();

            $main->move(
                public_path('uploads/digital/products'),
                $mainImageName
            );
        }


        /*
        |--------------------------------------------------------------------------
        | SAVE PRODUCT
        |--------------------------------------------------------------------------
        */

        $product = Product::create([
            'subcategory_id' => $request->subcategory_id,
            'title'          => $request->title,
            'brand'          => $request->brand,
            'product_code'   => $request->product_code,
            'price'          => $request->price,
            'original_price' => $request->original_price,
            'discount'       => $request->discount,
            'quantity'       => $request->quantity,

            'colors' => $request->has('colors')
                ? implode(',', $request->colors)
                : null,

            'size'        => $request->size,
            'description' => $request->description,
            'image'       => $mainImageName,
            'created_at'  => now(),
        ]);


        /*
        |--------------------------------------------------------------------------
        | MULTIPLE IMAGES
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $imageName = time()
                    . '_'
                    . rand(1000, 9999)
                    . '.'
                    . $image->getClientOriginalExtension();

                $image->move(
                    public_path('uploads/digital/products'),
                    $imageName
                );

                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $imageName,
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | REDIRECT TO DIGITAL PRODUCT LIST
        |--------------------------------------------------------------------------
        */

        return redirect()->route('digital.product.view') ->with('success', 'Product added successfully!');
    }


    /*
    |--------------------------------------------------------------------------
    | DIGITAL PRODUCT LIST
    |--------------------------------------------------------------------------
    */

    public function ProductlistView()
    {
        $products = Product::with('images')
            ->latest()
            ->get();

        return view('backend.digital.productList.index',compact('products'));
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT PRODUCT PAGE
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $product = Product::with('images')
            ->findOrFail($id);

        $subcategories = SubCategory::latest()->get();

        return view('backend.digital.productList.edit',compact('subcategories', 'product'));
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'subcategory_id' => 'required',
            'title'         => 'required',
            'brand'         => 'required',

            'product_code' => 'required|unique:digital_products,product_code,' . $product->id,

            'price'      => 'required',
            'discount'   => 'required',
            'quantity'   => 'required',
            'description'=> 'required',

            'image'      => 'nullable|image',
            'images.*'   => 'image',
        ]);


        /*
        |--------------------------------------------------------------------------
        | MAIN IMAGE UPDATE
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            /*
            | Delete old main image
            */

            if (
                $product->image &&
                file_exists(
                    public_path(
                        'uploads/digital/products/' . $product->image
                    )
                )
            ) {
                unlink(
                    public_path(
                        'uploads/digital/products/' . $product->image
                    )
                );
            }


            /*
            | Upload new main image
            */

            $main = $request->file('image');

            $mainImageName = time()
                . '_main.'
                . $main->getClientOriginalExtension();

            $main->move(
                public_path('uploads/digital/products'),
                $mainImageName
            );

            $product->image = $mainImageName;
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE PRODUCT INFORMATION
        |--------------------------------------------------------------------------
        */

        $product->update([
            'subcategory_id' => $request->subcategory_id,
            'title'          => $request->title,
            'brand'          => $request->brand,
            'product_code'   => $request->product_code,

            'price'          => $request->price,
            'original_price' => $request->original_price,
            'discount'       => $request->discount,

            'colors' => $request->has('colors')
                ? implode(',', $request->colors)
                : null,

            'quantity'   => $request->quantity,
            'size'       => $request->size,
            'description'=> $request->description,
        ]);


        /*
        |--------------------------------------------------------------------------
        | SAVE NEW MULTIPLE IMAGES
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $imageName = time()
                    . '_'
                    . rand(1000, 9999)
                    . '.'
                    . $image->getClientOriginalExtension();

                $image->move(
                    public_path('uploads/digital/products'),
                    $imageName
                );

                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $imageName,
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()->route('admin.digital.productlist.view') ->with('success', 'Product updated successfully!');
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $product = Product::with('images')
            ->findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | DELETE MAIN IMAGE
        |--------------------------------------------------------------------------
        */

        if (
            $product->image &&
            file_exists(
                public_path(
                    'uploads/digital/products/' . $product->image
                )
            )
        ) {
            unlink(
                public_path(
                    'uploads/digital/products/' . $product->image
                )
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DELETE MULTIPLE IMAGES
        |--------------------------------------------------------------------------
        */

        foreach ($product->images as $img) {

            if (
                $img->image &&
                file_exists(
                    public_path(
                        'uploads/digital/products/' . $img->image
                    )
                )
            ) {
                unlink(
                    public_path(
                        'uploads/digital/products/' . $img->image
                    )
                );
            }

            $img->delete();
        }


        /*
        |--------------------------------------------------------------------------
        | DELETE PRODUCT
        |--------------------------------------------------------------------------
        */

        $product->delete();

        return back()
            ->with('success', 'Product deleted successfully!');
    }


    /*
    |--------------------------------------------------------------------------
    | PRODUCT DETAILS
    |--------------------------------------------------------------------------
    */

    public function details($id)
    {
        $product = Product::with('images')
            ->findOrFail($id);

        /*
        | Prevent null colors from causing problems
        */

        if (is_null($product->colors)) {
            $product->colors = '';
        }

        /*
        | Your database uses "size", not "sizes"
        */

        if (is_null($product->size)) {
            $product->size = '';
        }

        return view('backend.digital.productDetails.index',compact('product'));
    }
}
