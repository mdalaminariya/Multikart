<?php

namespace App\Http\Controllers\page;

use App\Http\Controllers\Controller;
use App\Models\Page\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $pages = Page::query()
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('backend.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('backend.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
        ]);

        Page::create([
            'name' => $request->name,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'status' => $request->status ?? 'waiting',
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page created successfully');
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);

        return view('backend.pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
        ]);

        $page->update([
            'name' => $request->name,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'status' => $request->status ?? 'waiting',
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page updated successfully');
    }

    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page deleted successfully');
    }
}
