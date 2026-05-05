<?php

namespace App\Http\Controllers\Backend\Digital;

use App\Http\Controllers\Controller;
use App\Models\Digital\Product\Product;
use App\Models\Digital\Product\ProductImage;
use App\Models\Digital\category\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::latest()->get();
        return view('backend.digital.product.index', compact('subcategories'));
    }

public function store(Request $request)
{
    $request->validate([
        'subcategory_id' => 'required',
        'title'          => 'required',
        'sku'            => 'required|unique:digital_products,sku',
        'quantity'       => 'required',
        'price'          => 'required',
        'images'         => 'required|image',
        'colors'         => 'nullable|array'
    ]);

    $status = $request->status == 1 ? 'enable' : 'disable';

    $imageName = null;

    if ($request->hasFile('images')) {
        $file = $request->file('images');
        $imageName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/digital/products'), $imageName);
    }

    Product::create([
        'subcategory_id'   => $request->subcategory_id,
        'title'            => $request->title,
        'sku'              => $request->sku,
        'short_summary'    => $request->short_summary,
        'price'            => $request->price,
        'quantity'         => $request->quantity,
        'status'           => $status,
        'description'      => $request->description,
        'meta_title'       => $request->meta_title,
        'meta_description' => $request->meta_description,
        'colors'           => $request->colors ? implode(',', $request->colors) : null,
        'images'           => $imageName,
    ]);

    return redirect()->route('admin.digital.product.view')
        ->with('success', 'Product created successfully!');
}


public function view(){
    $products = Product::first()->get();
    return view('backend.digital.productList.index', compact('products'));
}

public function edit($id){
    $product = Product::where('id',$id)->first();
    $subcategories = SubCategory::latest()->get();
    return view('backend.digital.productList.edit', compact('subcategories','product'));
}
public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'subcategory_id' => 'required',
        'title'          => 'required',
        'sku'            => 'required|unique:digital_products,sku,' . $product->id,
        'price'          => 'required',
        'images'         => 'nullable|image',
        'colors'         => 'nullable|array'
    ]);

    $status = $request->status == 1 ? 'enable' : 'disable';

    $imageName = $product->images;

    if ($request->hasFile('images')) {

        if ($product->images && file_exists(public_path('uploads/digital/products/' . $product->images))) {
            unlink(public_path('uploads/digital/products/' . $product->images));
        }

        $file = $request->file('images');
        $imageName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/digital/products'), $imageName);
    }

    $product->update([
        'subcategory_id'   => $request->subcategory_id,
        'title'            => $request->title,
        'sku'              => $request->sku,
        'short_summary'    => $request->short_summary,
        'price'            => $request->price,
        'quantity'         => $request->quantity,
        'status'           => $status,
        'description'      => $request->description,
        'meta_title'       => $request->meta_title,
        'meta_description' => $request->meta_description,
        'colors'           => $request->colors ? implode(',', $request->colors) : null,
        'images'           => $imageName,
    ]);

    return redirect()->route('admin.digital.product.view')
        ->with('success', 'Product updated successfully!');
}

public function delete($id)
{
    $product = Product::findOrFail($id);

    if ($product->images && file_exists(public_path('uploads/digital/products/' . $product->images))) {
        unlink(public_path('uploads/digital/products/' . $product->images));
    }

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

    return view('backend.digital.productDetails.index', compact('product'));
}
}
