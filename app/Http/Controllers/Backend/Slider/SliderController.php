<?php

namespace App\Http\Controllers\Backend\Slider;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('sort_order')
            ->latest()
            ->get();

        return view('backend.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('backend.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'link' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:250',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' .
                $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(
                public_path('uploads/sliders'),
                $imageName
            );
        }

        Slider::create([
            'title' => $request->title,
            'image' => $imageName,
            'link' => $request->link,
            'description'=> $request->description,
            'status' => $request->status,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()
            ->route('admin.sliders.index')
            ->with('success', 'Slider added successfully.');
    }

    public function edit(Slider $slider)
    {
        return view('backend.slider.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'link' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = [
            'title' => $request->title,
            'link' => $request->link,
            'status' => $request->status,
            'sort_order' => $request->sort_order ?? 0,
        ];

        if ($request->hasFile('image')) {

            $oldImage = public_path(
                'uploads/sliders/' . $slider->image
            );

            if ($slider->image && File::exists($oldImage)) {
                File::delete($oldImage);
            }

            $imageName = time() . '_' . uniqid() . '.' .
                $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(
                public_path('uploads/sliders'),
                $imageName
            );

            $data['image'] = $imageName;
        }

        $slider->update($data);

        return redirect()
            ->route('admin.sliders.index')
            ->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        $imagePath = public_path(
            'uploads/sliders/' . $slider->image
        );

        if ($slider->image && File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $slider->delete();

        return redirect()
            ->route('admin.sliders.index')
            ->with('success', 'Slider deleted successfully.');
    }

    public function status(Slider $slider)
    {
        $slider->status = $slider->status === 'active'
            ? 'inactive'
            : 'active';

        $slider->save();

        return redirect()
            ->route('admin.sliders.index')
            ->with('success', 'Slider status updated successfully.');
    }
}
