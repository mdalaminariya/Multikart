<?php

namespace App\Http\Controllers\Backend\Physical;

use App\Http\Controllers\Controller;
use App\Models\Physical\category\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    public function index()
    {   $categories = Category::latest()->get();
        return view('backend.physical.category.index', compact('categories'));
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'image' => 'required|image',
    ]);

    $newname = null;

    if ($request->hasFile('image')) {
        $manager = new ImageManager(new Driver());

        $newname = auth()->id() . '-' . now()->format('Y-m-d-H-i-s') . '-' . rand(1111,9999) . '.png';

        $image = $manager->read($request->file('image'));
        $image->toPng()->save(public_path('uploads/physical/categories/' . $newname));
    }

    Category::create([
        'name' => $request->name,
        'image' => $newname,
    ]);

    return back()->with('success', 'Category created successfully!');
}
public function edit($id)
{
    $categories = Category::where('id', $id)->first();
    return view('backend.products.physical.category.edit', compact('categories'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'image' => 'nullable|image',
    ]);

    $category = Category::findOrFail($id);

    $category->name = $request->name;

    if ($request->hasFile('image')) {

        // delete old
        if ($category->image) {
            $oldImagePath = public_path('uploads/physical/categories/' . $category->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $filename = auth()->id() . '-' . now()->format('Y-m-d-H-i-s') . '-' . rand(1111,9999) . '.png';

        $request->file('image')->move(
            public_path('uploads/physical/categories'),
            $filename
        );

        $category->image = $filename;
    }

    $category->save();

    return back()->with('success', 'Category updated successfully');
}

public function delete($id)
{
    $category = Category::findOrFail($id);

    if ($category->image) {
        $path = public_path('uploads/physical/categories/' . $category->image);
        if (file_exists($path)) {
            unlink($path);
        }
    }

    $category->delete();

    return back()->with('success', 'Category deleted successfully');
}
}
