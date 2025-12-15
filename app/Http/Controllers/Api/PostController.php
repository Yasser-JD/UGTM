<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return Post::with('category')
            ->where('is_published', true)
            ->latest()
            ->paginate(10);
    }

    public function show($id)
    {
        return Post::with('category')
            ->where('is_published', true)
            ->findOrFail($id);
    }
}
