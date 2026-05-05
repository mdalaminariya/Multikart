<?php

namespace App\Http\Controllers\Backend\Digital;

use App\Http\Controllers\Controller;
use App\Models\Digital\category\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    public function index()
    {   $categories = Category::latest()->get();
        return view('backend.digital.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $manager = new ImageManager(new Driver());
        $request->validate([
            'name' => 'required',
            'image' => 'required|image',
        ]);

       if($request->hasFile('image')){
        $newname = auth()->user()->id .'-'.now()->format('Y-m-d-H-i-s').'-'.rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
        $image = $manager->read($request->file('image'));
        $image->toPng()->save(public_path('uploads/digital/categories'.$newname));
        }
        Category::create([
            'name' => $request->name,
            'image' => $newname,
            'created_at' => now(),
        ]);
        return back()->with('success', 'Category created successfully!');
    }
public function edit($id)
{
    $categories = Category::where('id', $id)->first();
    return view('backend.products.digital.category.edit', compact('categories'));
}

public function update(Request $request, $id)
{
    $category = Category::where('id', $id)->first();

    $category->name = $request->name;

    if ($request->hasFile('image')) {
        if ($category->image) {
            $oldImagePath = public_path('uploads/categories/' . $category->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $file = $request->file('image');
        $filename =  auth()->user()->id .'-'.now()->format('Y-m-d-H-i-s').'-'.rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
        $file->move(public_path('uploads/digital/categories'), $filename);
        $category->image = $filename;
    }

    $category->save();

    return back()->with('success', 'Category updated successfully');
}

public function delete($id)
{
    $category = Category::where('id', $id)->first();
    if ($category->image) {
        $oldImagePath = public_path('uploads/digital/categories' . $category->image);
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
    }
    $category->delete();
    return back()->with('success', 'Category deleted successfully');
}
}
