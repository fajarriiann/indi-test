<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TagController extends Controller
{
    public function index(): View
    {
        $data = Tag::all();

        return view('contents.tag.index', compact('data'));
    }

    public function create(): View
    {
        return view('contents.tag.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
        ]);

        Tag::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('status', 'tag-created');
    }

    public function edit($id): View
    {
        $data = Tag::where('id', $id)
        ->first();

        return view('contents.tag.edit', compact('data'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
        ]);

        Tag::where('id', $id)
        ->update([
            'name' => $request->name
        ]);

        return redirect()->back()->with('status', 'tag-updated');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();

        return redirect()->back();
    }
}
