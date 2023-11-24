<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $data = Category::all();

        return view('contents.category.index', compact('data'));
    }

    public function create(): View
    {
        return view('contents.category.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('status', 'category-created');
    }

    public function edit($id): View
    {
        $data = Category::where('id', $id)
        ->first();

        return view('contents.category.edit', compact('data'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
        ]);

        Category::where('id', $id)
        ->update([
            'name' => $request->name
        ]);

        return redirect()->back()->with('status', 'category-updated');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->back();
    }
}
