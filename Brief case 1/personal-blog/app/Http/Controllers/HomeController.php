<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $data = Article::with(['category', 'user'])
        ->get();

        return view('article', compact('data'));
    }

    public function articleDetail($slug): View
    {
        $data = Article::where('slug', $slug)
        ->first();

        return view('article-detail', compact('data'));
    }
}
