<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function index(): View
    {
        $data = Item::all();

        return view('contents.item.index', compact('data'));
    }

    public function create(): View
    {
        return view('contents.item.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|integer'
        ]);

        Item::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price
        ]);

        return redirect()->back()->with('status', 'item-created');
    }

    public function edit($id): View
    {
        $data = Item::where('id', $id)
        ->first();

        return view('contents.item.edit', compact('data'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|integer'
        ]);

        Item::where('id', $id)
        ->update([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price
        ]);

        return redirect()->back()->with('status', 'item-updated');
    }

    public function destroy($id): RedirectResponse
    {
        Item::where('id', $id)
        ->delete();

        return redirect()->back();
    }
}
