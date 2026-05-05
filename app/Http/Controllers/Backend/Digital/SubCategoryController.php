<?php
namespace App\Http\Controllers\Backend\Digital;

use App\Http\Controllers\Controller;
use App\Models\Digital\category\Category;
use App\Models\Digital\category\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();

        return view('backend.digital.subcategory.index', compact('subcategories', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'image' => 'required|image',
        ]);

        $newname = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $newname = auth()->id() . '-' . now()->format('Y-m-d-H-i-s') . '-' . rand(1111,9999)
                . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/digital/subcategories'), $newname);
        }

        SubCategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'image' => $newname,
        ]);

        return back()->with('success', 'SubCategory created successfully!');
    }

    public function edit($id)
    {
        $subcategory = SubCategory::findOrFail($id);

        return view('backend.digital.subcategory.edit', compact('subcategory'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:digital_categories,id',
            'name' => 'required',
            'image' => 'nullable|image',
        ]);

        $subcategory = SubCategory::where('id',$id)->first();

        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;

        if ($request->hasFile('image')) {

            if ($subcategory->image) {
                $oldImagePath = public_path('uploads/digital/subcategories' . $subcategory->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file = $request->file('image');

            $filename = auth()->id() . '-' . now()->format('Y-m-d-H-i-s') . '-' . rand(1111,9999)
                . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/digital/subcategories'), $filename);

            $subcategory->image = $filename;
        }

        $subcategory->save();

        return back()->with('success', 'SubCategory updated successfully');
    }

    public function delete($id)
    {
        $subcategory = SubCategory::findOrFail($id);

        if ($subcategory->image) {
            $oldImagePath = public_path('uploads/digital/subcategories' . $subcategory->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $subcategory->delete();

        return back()->with('success', 'SubCategory deleted successfully');
    }
}
