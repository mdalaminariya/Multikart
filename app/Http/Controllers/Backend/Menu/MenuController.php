<?php

namespace App\Http\Controllers\Backend\Menu;

use App\Http\Controllers\Controller;
use App\Models\Menu\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Menu List
     */
    public function index()
    {
        $menus = Menu::latest()->get();

        return view('backend.menu.index', compact('menus'));
    }



    /**
     * Create Menu Page
     */
    public function create()
    {
        return view('backend.menu.create');
    }



    /**
     * Store Menu
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

            Menu::create([

                'name'      => $request->name,

                'slug'      => Str::slug($request->name),

                'url'       => $request->url,

                'icon'      => $request->icon,

                'parent_id' => $request->parent_id,

                'position'  => $request->position ?? 0,

                'status'    => $request->status,

            ]);

        return redirect()->route('admin.menu.index')->with('success', 'Menu Created Successfully');
    }



    /**
     * Edit Menu Page
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);

        return view('backend.menu.edit', compact('menu'));
    }



    /**
     * Update Menu
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $menu->update([

            'name'      => $request->name,

            'slug'      => Str::slug($request->name),

            'url'       => $request->url,

            'icon'      => $request->icon,

            'parent_id' => $request->parent_id,

            'position'  => $request->position ?? 0,

            'status'    => $request->status ? 1 : 0,

        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Menu Updated Successfully');
    }



    /**
     * Delete Menu
     */
public function destroy($id)
{
    $menu = Menu::findOrFail($id);

    $menu->delete();

    return redirect()->back()->with('success', 'Menu Deleted Successfully');
}
}
