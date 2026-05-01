<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Show menu items
     */
    public function index()
    {
        $items = Item::where('deleted', false)
            ->paginate(12);
        
        return view('menu.index', compact('items'));
    }

    /**
     * Show item details
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('menu.show', compact('item'));
    }

    /**
     * Admin: List all items
     */
    public function adminIndex()
    {
        $items = Item::orderBy('id', 'desc')->paginate(10);
        return view('admin.items.index', compact('items'));
    }

    /**
     * Admin: Show add item form
     */
    public function create()
    {
        return view('admin.items.create');
    }

    /**
     * Admin: Store item
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20|unique:items',
            'price' => 'required|numeric|min:0',
        ]);

        Item::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.items.index')
            ->with('success', 'Item added successfully!');
    }

    /**
     * Admin: Show edit form
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('admin.items.edit', compact('item'));
    }

    /**
     * Admin: Update item
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'price' => 'required|numeric|min:0',
        ]);

        Item::findOrFail($id)->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.items.index')
            ->with('success', 'Item updated successfully!');
    }

    /**
     * Admin: Delete item
     */
    public function destroy($id)
    {
        Item::findOrFail($id)->update(['deleted' => true]);
        return back()->with('success', 'Item deleted!');
    }
}
