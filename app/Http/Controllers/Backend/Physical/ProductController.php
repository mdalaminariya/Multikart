<?php

namespace App\Http\Controllers\Backend\Physical;

use App\Http\Controllers\Controller;
use App\Models\Physical\Product\Product;
use App\Models\Physical\Product\ProductImage;
use App\Models\Physical\category\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::latest()->get();
        return view('backend.physical.product.index', compact('subcategories'));
    }

public function store(Request $request)
{
    $request->validate([
        'subcategory_id' => 'required',
        'title' => 'required',
        'brand' => 'required',
        'product_code' => 'required|unique:products',
        'price' => 'required',
        'discount' => 'required',
        'quantity' => 'required',
        'description' => 'required',
        'image' => 'required|image',
        'images.*' => 'image'
    ]);

    // MAIN IMAGE UPLOAD
    $mainImageName = null;

    if ($request->hasFile('image')) {
        $main = $request->file('image');
        $mainImageName = time().'_main.'.$main->getClientOriginalExtension();
        $main->move(public_path('uploads/physical/products'), $mainImageName);
    }

    // SAVE PRODUCT
    $product =Product::create([
        'subcategory_id' => $request->subcategory_id,
        'title' => $request->title,
        'brand' => $request->brand,
        'product_code' => $request->product_code,
        'price' => $request->price,
        'original_price' => $request->original_price,
        'discount'       => $request->discount,
        'quantity' => $request->quantity,
        'colors' => $request->has('colors') ? implode(',', $request->colors) : null,
        'size' => $request->size,
        'description' => $request->description,
        'image' => $mainImageName,
        'created_at' => now(),
    ]);

    // MULTIPLE IMAGES
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imageName = time().'_'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/physical/products'), $imageName);

            ProductImage::create([
                'product_id' => $product->id,
                'image' => $imageName,
            ]);
        }
    }

    return redirect()->route('admin.product.view')->with('success', 'Product added successfully!');
}
public function view(){
    $products = Product::latest()->get();
    return view('backend.physical.productList.index', compact('products'));
}

public function edit($id){
    $product = Product::where('id',$id)->first();
    $subcategories = SubCategory::latest()->get();
    return view('backend.physical.productList.edit', compact('subcategories','product'));
}
public function update(Request $request, $id){

    $product = Product::findOrFail($id);

    $request->validate([
        'subcategory_id' => 'required',
        'title' => 'required',
        'brand' => 'required',
        'product_code' => 'required|unique:products,product_code,'.$product->id,
        'price' => 'required',
        'discount' => 'required',
        'quantity' => 'required',
        'description' => 'required',
        'image' => 'nullable|image',
        'images.*' => 'image'
    ]);

    // ======================
    // MAIN IMAGE UPDATE
    // ======================
    if ($request->hasFile('image')) {

        // delete old image (optional but recommended)
        if ($product->image && file_exists(public_path('uploads/products/physical/'.$product->image))) {
            unlink(public_path('uploads/physical/products/'.$product->image));
        }

        $main = $request->file('image');
        $mainImageName = time().'_main.'.$main->getClientOriginalExtension();
        $main->move(public_path('uploads/physical/products'), $mainImageName);

        $product->image = $mainImageName;
    }

    // ======================
    // UPDATE PRODUCT
    // ======================
    $product->update([
        'subcategory_id' => $request->subcategory_id,
        'title' => $request->title,
        'brand' => $request->brand,
        'product_code' => $request->product_code,
        'price' => $request->price,
        'original_price' => $request->original_price,
        'discount'       => $request->discount,
        'colors' => $request->has('colors') ? implode(',', $request->colors) : null,
        'quantity' => $request->quantity,
        'size' => $request->size,
        'description' => $request->description,
    ]);

    // ======================
    // ADD NEW MULTIPLE IMAGES
    // ======================
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imageName = time().'_'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/physical/products'), $imageName);

            ProductImage::create([
                'product_id' => $product->id,
                'image' => $imageName,
            ]);
        }
    }

    return redirect()->route('admin.product.view')->with('success', 'Product updated successfully!');
}

public function delete($id)
{
    $product = Product::with('images')->findOrFail($id);

    // ======================
    // DELETE MAIN IMAGE
    // ======================
    if ($product->image && file_exists(public_path('uploads/products/physical/' . $product->image))) {
        unlink(public_path('uploads/physical/products/' . $product->image));
    }

    // ======================
    // DELETE MULTIPLE IMAGES
    // ======================
    foreach ($product->images as $img) {
        if ($img->image && file_exists(public_path('uploads/products/physical/' . $img->image))) {
            unlink(public_path('uploads/physical/products/' . $img->image));
        }

        // delete DB row
        $img->delete();
    }

    // ======================
    // DELETE PRODUCT
    // ======================
    $product->delete();

    return back()->with('success', 'Product deleted successfully!');
}

//product details

public function details($id)
{
    $product = Product::findOrFail($id);

    // Ensure colors and sizes are set correctly (optional check)
    if (is_null($product->colors)) {
        $product->colors = '';  // Default empty string if null
    }

    if (is_null($product->sizes)) {
        $product->sizes = '';  // Default empty string if null
    }

    return view('backend.physical.productDetails.index', compact('product'));
}
}
