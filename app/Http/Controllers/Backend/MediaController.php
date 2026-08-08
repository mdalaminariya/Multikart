<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    // SHOW PAGE
    public function index()
    {
        $media = Media::latest()->get();

        return view('backend.media.index', compact('media'));
    }


    // STORE IMAGE
public function store(Request $request)
{
    $request->validate([
        'image' => 'required|image'
    ]);

    $image = $request->file('image');
    $imageName = time().'_'.$image->getClientOriginalName();

    $image->move(public_path('uploads/media'), $imageName);

    $media = new Media();
    $media->image = $imageName;
    $media->file_name = $image->getClientOriginalName();
    $media->url = asset('uploads/media/'.$imageName);
    $media->save();

    return redirect()->route('admin.media.index')
        ->with('success', 'Image uploaded successfully.');
}


    // DELETE
public function destroy(Request $request)
{
    $ids = $request->ids;

    if (!$ids) {
        return response()->json([
            'success' => false,
            'message' => 'No items selected'
        ]);
    }

    $mediaItems = Media::whereIn('id', $ids)->get();

    foreach ($mediaItems as $media) {

        if ($media->image) {
            $path = public_path('uploads/media/' . $media->image);

            if (file_exists($path)) {
                unlink($path);
            }
        }

        $media->delete();
    }

    return response()->json([
        'success' => true,
        'message' => 'Deleted successfully'
    ]);
}
}
