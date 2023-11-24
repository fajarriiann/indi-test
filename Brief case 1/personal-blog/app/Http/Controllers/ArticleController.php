<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $data = Article::with('category')
        ->get();

        return view('contents.article.index', compact('data'));
    }

    public function create(): View
    {
        $category = Category::get()
        ->pluck('name', 'id');
        $tag = Tag::get()
        ->pluck('name', 'id');

        return view('contents.article.create', compact('category', 'tag'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'cover' => 'required',
            'category' => 'required|exists:categories,id',
            'tag' => 'required',
            'content' => 'required'
        ]);

        if ($request->file('cover')) {
            $cover = $request->file('cover')->store('post-images', 'public');
        }

        Article::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => str()->slug($request->title),
            'cover' => $cover,
            'category_id' => $request->category,
            'tag' => json_encode($request->tag),
            'content' => $request->content
        ]);

        return redirect()->back()->with('status', 'article-created');
    }

    public function edit($id): View
    {
        $data = Article::where('id', $id)
        ->first();
        $category = Category::get()
        ->pluck('name', 'id');
        $tag = Tag::get()
        ->pluck('name', 'id');

        return view('contents.article.edit', compact('data', 'category', 'tag'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required|exists:categories,id',
            'tag' => 'required',
            'content' => 'required'
        ]);

        if ($request->file('cover')) {
            if($request->oldCover){
                Storage::delete('public/'.$request->oldCover);
            }
            $cover = $request->file('cover')->store('post-images', 'public');

            Article::where('id', $id)
            ->update([
                'cover' => $cover
            ]);
        }

        Article::where('id', $id)
        ->update([
            'title' => $request->title,
            'slug' => str()->slug($request->title),
            'category_id' => $request->category,
            'tag' => json_encode($request->tag),
            'content' => $request->content
        ]);

        return redirect()->back()->with('status', 'article-updated');
    }

    public function destroy(Article $article): RedirectResponse
    {
        if($article->cover){
            Storage::delete('public/'.$article->cover);
        }

        $article->delete();

        return redirect()->back();
    }
}
