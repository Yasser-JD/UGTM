<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = $category->posts()
            ->where('is_published', true)
            ->latest()
            ->paginate(12);

        $memos = \App\Models\Post::whereHas('category', function ($query) {
                $query->where('slug', 'memos');
            })
            ->where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        return view('categories.show', compact('category', 'posts', 'memos'));
    }
}
