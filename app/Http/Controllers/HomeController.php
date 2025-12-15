<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPosts = Post::where('is_published', true)
            ->where('is_featured', true)
            ->latest()
            ->take(5)
            ->get();

        // Fallback if no featured posts exist
        if ($featuredPosts->isEmpty()) {
            $fallbackPost = Post::where('is_published', true)
                ->where('is_urgent', true)
                ->latest()
                ->first();
            
            if ($fallbackPost) {
                $featuredPosts = collect([$fallbackPost]);
            }
        }

        $latestPosts = Post::where('is_published', true)
            ->whereNotIn('id', $featuredPosts->pluck('id'))
            ->latest()
            ->take(6)
            ->get();

        $memos = Post::whereHas('category', function ($query) {
                $query->where('slug', 'memos');
            })
            ->where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact('featuredPosts', 'latestPosts', 'memos'));
    }
}
